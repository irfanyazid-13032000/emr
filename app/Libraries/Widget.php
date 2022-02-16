<?php

namespace App\Libraries;


class Widget
{
    // init base variable
    protected $portal_id;
    protected $com_portal;
    protected $com_user;
    protected $nav_id = 0;
    protected $parent_id = 0;
    protected $parent_selected = 0;
    protected $role_tp = array();

    public function __construct()
    {
        $this->portal_id = 2;
        $this->role_id = 6;
        $this->user_id = 1241;

        $this->m_site = new \App\Models\M_site();
    }

    public function sidebar()
    {
        $params = array($this->portal_id, $this->role_id, $this->user_id, 0);
        $rs_id = $this->m_site->get_navigation_user_by_parent($params);



        if (!$rs_id) return;

        $request = \Config\Services::request();
        $url_menu = $request->uri->getSegment(1) . '/' . $request->uri->getSegment(2);
        $url_menu = trim($url_menu, '/');
        $url_menu = (empty($url_menu)) ? getenv('default_operator') : $url_menu;
        $result = $this->m_site->get_current_page(array($url_menu));
        if (!empty($result)) {
            $this->nav_id = $result['nav_id'];
            $this->parent_id = $result['parent_id'];
        }

        $html = '<ul class="menu">';
        foreach ($rs_id as $rec) {
            // parent active
            $parent_active = '';
            $this->parent_selected = self::_get_parent_group($this->parent_id, 0);
            if ($this->parent_selected == 0) {
                $this->parent_selected = $this->nav_id;
            }
            // icon
            $icon = "resource/doc/images/nav/default.png";
            if (is_file("resource/doc/images/nav/" . $rec['nav_icon'])) {
                $icon = "resource/doc/images/nav/" . $rec['nav_icon'];
            }
            // get child navigation
            $url_parent = site_url($rec['nav_url']);
            $child = $this->_get_child_navigation($rec['nav_id']);
            $hasSub = false;
            $parentActiveClass = '';
            if (!empty($child)) {
                $hasSub = true;
                $parent_active = 'class="parent"';
                $url_parent = 'javascript:void(0)';
            }
            // parent active
            if ($this->parent_selected == $rec['nav_id']) {
                $parent_active = 'class="side-active"';
                $parentActiveClass = 'active';
            }
            // data
            $html .= '<li class="sidebar-item ' . ($hasSub ? 'has-sub ' : ' ') . $parentActiveClass . '">';
            $html .= '<a class="sidebar-link" ' . $parent_active . ' href="' . $url_parent . '"><img src="' . base_url() . $icon . '" alt="" /><span>' . $rec['nav_title'] . '</span></a>';
            $html .= $child;
            $html .= '</li>';
        }
        $html .= '</ul>';
        return $html;
        return json_encode($rs_id);
    }

    // get child
    private function _get_child_navigation($parent_id)
    {
        $html = "";
        // get parent selected
        $parent_selected = self::_get_parent_group($this->parent_id, $parent_id);
        if ($parent_selected == 0) {
            $parent_selected = $this->nav_id;
        }
        // if parent selected then show child
        $expand = '';
        $top = self::_get_parent_group($this->parent_id, 0);
        if ($parent_id == $top) {
            $expand = 'active';
        }
        // --
        $params = array($this->portal_id, $this->role_id, $this->user_id, $parent_id);
        $rs_id = $this->m_site->get_navigation_user_by_parent($params);
        if ($rs_id) {
            $html = '<ul class="submenu ' . $expand . '">';
            foreach ($rs_id as $rec) {
                // selected
                $selected = ($rec['nav_id'] == $parent_selected) ? 'active' : "";
                $icon = "resource/doc/images/nav/default.png";
                if (is_file("resource/doc/images/nav/" . $rec['nav_icon'])) {
                    $icon = "resource/doc/images/nav/" . $rec['nav_icon'];
                }
                // parse
                $html .= '<li class="submenu-item ' . $selected . '">';
                $html .= '<a href="' . site_url($rec['nav_url']) . '" title="' . $rec['nav_desc'] . '">';
                // $html .= '<img src="' . site_url() . $icon . '" alt="" />';
                $html .= $rec['nav_title'];
                $html .= '</a>';
                $html .= '</li>';
            }
            $html .= '</ul>';
        }
        return $html;
    }

    // utility to get parent selected
    private function _get_parent_group($int_nav, $int_limit)
    {
        $selected_parent = 0;
        $result = $this->m_site->get_menu_by_id($int_nav);
        if (!empty($result)) {
            if ($result['parent_id'] == $int_limit) {
                $selected_parent = $result['nav_id'];
            } else {
                return self::_get_parent_group($result['parent_id'], $int_limit);
            }
        } else {
            $selected_parent = 0; //$result['nav_id'];
        }
        return $selected_parent;
    }
}

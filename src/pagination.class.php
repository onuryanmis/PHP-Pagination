<?php

/**
 *
 * @author Onur yanmış <onuryanmis@webderslerim.com>
 * @version 1.0
 *
 */
class Pagination
{
    /**
     * @var string
     */
    private $url = "";

    /**
     * @var int
     */
    private $total = 0;

    /**
     * @var int
     */
    private $per_page = 10;

    /**
     * @var int
     */
    private $current_page = 0;

    /**
     * @var bool
     */
    private $first_last_page = true;

    /**
     * @var bool
     */
    private $prev_next = true;

    /**
     * @var bool
     */
    private $query_string = true;

    /**
     * @var string
     */
    private $query_string_name = "page";

    /**
     * @var string
     */
    private $open = "";

    /**
     * @var string
     */
    private $close = "";

    /**
     * @var array
     */
    private $page = [
        "before" => "",
        "content" => "(:num)",
        "after" => "",
        "attr" => []
    ];

    /**
     * @var array
     */
    private $cur_page = [
        "before" => "",
        "content" => "(:num)",
        "after" => "",
        "attr" => ["class" => "active"]
    ];

    /**
     * @var array
     */
    private $first_page = [
        "before" => "",
        "content" => "&lsaquo; İlk",
        "after" => "",
        "attr" => []
    ];

    /**
     * @var array
     */
    private $last_page = [
        "before" => "",
        "content" => "Son &rsaquo;",
        "after" => "",
        "attr" => []
    ];

    /**
     * @var array
     */
    private $prev_page = [
        "before" => "",
        "content" => "&lt;",
        "after" => "",
        "attr" => []
    ];

    /**
     * @var array
     */
    private $next_page = [
        "before" => "",
        "content" => "&gt;",
        "after" => "",
        "attr" => []
    ];


    /**
     * Pagination constructor.
     * @param array $config
     */
    public function __construct($config = [], $theme = "")
    {
        if($theme == "bs4")
        {
            $config = $this->_bs4_config($config);
        }else if($theme == "bs3")
        {
            $config = $this->_bs3_config($config);
        }

        foreach ($config as $key => $value) {
            if (isset($this->$key) && isset($config[$key])) {
                if (is_array($value)) {
                    $this->$key = array_replace($this->$key, $value);
                } else {
                    $this->$key = $value;
                }
            }
        }
    }

    /**
     * Bootstrap3 config
     * @param $config
     * @return mixed
     */
    private function _bs3_config($config)
    {
        $theme_config["open"] = '<nav><ul class="pagination">';
        $theme_config["close"] = '</ul></nav>';
        $theme_config["first_page"] = [
            "before"=>'<li>',
            "after"=>'</li>'
        ];
        $theme_config["last_page"] = [
            "before"=>'<li>',
            "after"=>'</li>'
        ];
        $theme_config["prev_page"] = [
            "before"=>'<li>',
            "after"=>'</li>'
        ];
        $theme_config["next_page"] = [
            "before"=>'<li>',
            "after"=>'</li>'
        ];
        $theme_config["page"] = [
            "before"=>'<li>',
            "after"=>'</li>'
        ];

        $theme_config["cur_page"] = [
            "before"=>'<li class="active">',
            "after"=>'</li>',
            "content"=>'(:num) <span class="sr-only">(current)</span>',

        ];
        $pages = ["first_page","last_page","prev_page","next_page","page","cur_page"];
        foreach ($pages as $page)
        {
            if(isset($config[$page]))
            {
                $theme_config[$page] = array_replace($theme_config[$page], $config[$page]);
            }
        }
        return array_merge($config,$theme_config);
    }

    /**
     * Bootstrap4 config
     * @param $config
     * @return mixed
     */
    private function _bs4_config($config)
    {
        $theme_config["open"] = '<nav><ul class="pagination">';
        $theme_config["close"] = '</ul></nav>';
        $theme_config["first_page"] = [
            "before"=>'<li class="page-item">',
            "after"=>'</li>',
            "attr"=>[
                "class"=>"page-link"
            ]
        ];
        $theme_config["last_page"] = [
            "before"=>'<li class="page-item">',
            "after"=>'</li>',
            "attr"=>[
                "class"=>"page-link"
            ]
        ];
        $theme_config["prev_page"] = [
            "before"=>'<li class="page-item">',
            "after"=>'</li>',
            "attr"=>[
                "class"=>"page-link"
            ]
        ];
        $theme_config["next_page"] = [
            "before"=>'<li class="page-item">',
            "after"=>'</li>',
            "attr"=>[
                "class"=>"page-link"
            ]
        ];
        $theme_config["page"] = [
            "before"=>'<li class="page-item">',
            "after"=>'</li>',
            "attr"=>[
                "class"=>"page-link"
            ]
        ];

        $theme_config["cur_page"] = [
            "before"=>'<li class="page-item active">',
            "after"=>'</li>',
            "content"=>'(:num) <span class="sr-only">(current)</span>',
            "attr"=>[
                "class"=>"page-link"
            ]
        ];
        $pages = ["first_page","last_page","prev_page","next_page","page","cur_page"];
        foreach ($pages as $page)
        {
            if(isset($config[$page]))
            {
                $theme_config[$page] = array_replace($theme_config[$page], $config[$page]);
            }
        }
        return array_merge($config,$theme_config);
    }


    /**
     * Get config
     * @param string $configName
     * @return string
     */
    public function getConfig($configName = "")
    {
        if ($configName != "") {
            return isset($this->$configName) ? $this->$configName : '';
        }
    }

    /**
     * Create pagination
     * @return string
     */
    public function create()
    {
        $pagination_html = $this->open;
        $total_page = ceil($this->total / $this->per_page);
        $first_page = 1;
        $current_page = intval($this->current_page);
        if($current_page < 1)
        {
            $current_page = 1;
        }
        if($current_page > $total_page)
        {
            $current_page = $total_page;
        }
        if ($total_page != 1) {
            if ($current_page != 1) {
                if ($current_page > 3 && $this->first_last_page == true) {
                    // Add first page link
                    $pagination_html .= $this->_create_button([
                        "href" => $this->_createUrl($first_page),
                        "content" => $this->first_page["content"],
                        "before" => $this->first_page["before"],
                        "after" => $this->first_page["after"],
                        "attr" => $this->first_page["attr"]
                    ]);
                }
                if ($this->prev_next == true) {
                    // Add previous page link
                    $previous_page = $current_page - 1;
                    $pagination_html .= $this->_create_button([
                        "href" => $this->_createUrl($previous_page),
                        "content" => $this->prev_page["content"],
                        "before" => $this->prev_page["before"],
                        "after" => $this->prev_page["after"],
                        "attr" => $this->prev_page["attr"]
                    ]);
                }
            }

            if ($current_page > 1) {
                // Add previous 2 numbers
                for ($i = ($current_page - 2); $i < $current_page; $i++) {
                    if ($i != 0) {
                        $page_number = str_replace("(:num)", $i, $this->page["content"]);
                        $pagination_html .= $this->_create_button([
                            "href" => $this->_createUrl($i),
                            "content" => $page_number,
                            "before" => $this->page["before"],
                            "after" => $this->page["after"],
                            "attr" => $this->page["attr"]
                        ]);
                    }
                }
            }

            // Current Page
            $page_number = str_replace("(:num)", $current_page, $this->cur_page["content"]);     
            $pagination_html .= $this->_create_button([
                "href" => "",
                "content" => $page_number,
                "before" => $this->cur_page["before"],
                "after" => $this->cur_page["after"],
                "attr" => $this->cur_page["attr"]
            ]);

            if ($current_page != $total_page) {
                // Add next 2 numbers
                for ($i = ($current_page + 1); $i <= ($current_page + 2); $i++) {
                    if ($i != ($total_page + 1)) {
                        $page_number = str_replace("(:num)", $i, $this->page["content"]);
                        $pagination_html .= $this->_create_button([
                            "href" => $this->_createUrl($i),
                            "content" => $page_number,
                            "before" => $this->page["before"],
                            "after" => $this->page["after"],
                            "attr" => $this->page["attr"]
                        ]);
                    }
                }
            }
            if ($current_page != $total_page) {
                // Add next page link
                if ($this->prev_next == true) {
                    $next_page = $current_page + 1;
                    $pagination_html .= $this->_create_button([
                        "href" => $this->_createUrl($next_page),
                        "content" => $this->next_page["content"],
                        "before" => $this->next_page["before"],
                        "after" => $this->next_page["after"],
                        "attr" => $this->next_page["attr"]
                    ]);
                }
                if (($current_page + 2) < $total_page && $this->first_last_page == true) {
                    // Add last page link
                    $pagination_html .= $this->_create_button([
                        "href" => $this->_createUrl($total_page),
                        "content" => $this->last_page["content"],
                        "before" => $this->last_page["before"],
                        "after" => $this->last_page["after"],
                        "attr" => $this->last_page["attr"]
                    ]);
                }
            }
        }
        $pagination_html .= $this->close;
        return $pagination_html;
    }

    /**
     * Create button
     * @param array $config
     * @return string
     */
    private function _create_button($config = [])
    {
        return $config["before"] . '<a href="' . $config["href"] . '"' . $this->create_attr($config["attr"]) . '>' . $config["content"] . '</a>' . $config["after"];
    }

    /**
     * Create button attributes
     * @param array $attr
     * @return string
     */
    private function create_attr($attr = [])
    {
        if (count($attr) == 0 && !is_array($attr)) {
            return "";
        } else {
            $attr_data = [];
            foreach ($attr as $key => $value) {
                $attr_data[] = $key . '="' . $value . '"';
            }
            return " " . implode(" ", $attr_data);
        }
    }


    /**
     * Create button link
     * @param $page
     * @return string
     */
    private function _createUrl($page)
    {
        if ($page == 1) {
            $url = $this->url;
        } else {
            if($this->query_string == true)
            {
                $parse_url = parse_url($this->url);
                if(isset($parse_url["query"]))
                {
                    $separator = "&";
                }else{
                    $separator = '?';
                }

                $url = $this->url . $separator.$this->query_string_name."=" . intval($page);
            }else{

                $url = $this->url . "/" . intval($page);
                echo $url."<br>";
            }
        }
        return $url;
    }

    /**
     * Limit value for database
     * @return int
     */
    public function getLimit()
    {
        $total_page = ceil($this->total / $this->per_page);
        $current_page = intval($this->current_page);
        if($current_page < 1)
        {
            $current_page = 1;
        }
        if($current_page > $total_page)
        {
            $current_page = $total_page;
        }
        return ((int)$current_page - 1) * $this->per_page;
    }

}

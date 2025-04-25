<?php
global $WPSAF;
$WPSAF = new WPSAF();
if ($_POST["newwpsafelink"]) {
    $linktarget = json_decode(base64_decode($_POST["newwpsafelink"]), true);
    $_GET["newsafelink"] = $linktarget;
}
checkupdatewpsafelink();
class WPSAF
{
    public function __construct()
    {
        add_action("admin_menu", [$this, "wp_safelink_menu"]);
        add_filter("home_template", [$this, "ch_register_page_template"]);
        add_filter("page_template", [$this, "ch_register_page_template"]);
        add_filter("single_template", [$this, "ch_register_page_template"]);
        add_shortcode("wpsafelink", [$this, "wpsafcode"]);
        add_action("init", [$this, "custom_rewrite"]);
        add_action("in_admin_footer", [$this, "foot_admin"], 999);
        add_action("wp_footer", [$this, "footer_wp_safelink"], 999);
    }
    public function custom_rewrite()
    {
        $wpsaf = json_decode(get_settings("wpsaf_options"));
        if ($wpsaf->permalink == 1) {
            add_rewrite_rule("^" . $wpsaf->permalink1 . "/(.*)?", "index.php", "top");
            flush_rewrite_rules();
            remove_filter("template_redirect", "redirect_canonical");
        }
    }
    public function wpsafcode($link)
    {
        $wpsaf = json_decode(get_settings("wpsaf_options"));
        $link = array_map("trim", $link);
        $link = implode("", $link);
        if ($link[0] == "=") {
            $link = substr($link, 1, 999);
        }
        if ($wpsaf->permalink == 1) {
            $linkout = home_url() . "/" . $wpsaf->permalink1 . "/" . base64_encode($link);
        } else {
            if ($wpsaf->permalink == 2) {
                $linkout = home_url() . "/?" . $wpsaf->permalink2 . "=" . base64_encode($link);
            } else {
                $linkout = home_url() . "/?" . base64_encode($link);
            }
        }
        return $linkout;
    }
public function wp_safelink_menu()
{
    add_menu_page(
        "Droplink Plus",  
        "Droplink Plus",        
        "manage_options",    
        "droplink",       
        [$this, "wp_safelink_options"], 
        "dashicons-admin-links",  
        25                       
    );
}
    public function ch_register_page_template($page_template)
    {
        global $wpdb;
        $wpsaf = json_decode(get_settings("wpsaf_options"));
        $urls = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        $URI = str_replace(["http://", "https://"], "", home_url());
        $URI = str_replace($URI, "", $urls);
        $url = explode("/", $URI);
        if (isset($_GET["redir"]) && !empty($_GET["redir"]) || isset($_GET["wpsafelink"])) {
            $go = "";
            switch ($wpsaf->permalink) {
                case 1:
                    $go = $url[2];
                    break;
                case 2:
                    $go = $_GET[$wpsaf->permalink2];
                    break;
                case 3:
                    $url = explode("?", $url[1]);
                    $go = $url[1];
                    break;
                default:
                    if (isset($_GET["wpsafelink"])) {
                        $go = base64_encode($_GET["wpsafelink"]);
                    }
                    if (empty($_GET["redir"])) {
                        $_GET["redir"] = base64_encode(home_url() . "/");
                    }
                    echo "\t\t\t<html>\r\n\r\n\t\t\t<head>\r\n\t\t\t\t<title>Landing..</title>\r\n\t\t\t\t<meta name=\"referrer\" content=\"no-referrer\">\r\n\t\t\t</head>\r\n\r\n\t\t\t<body>\r\n\t\t\t\t<form id=\"landing\" method=\"POST\" action=\"";
                    echo base64_decode($_GET["redir"]);
                    echo "\">\r\n\t\t\t\t\t<input type=\"hidden\" name=\"go\" value=\"";
                    echo $go;
                    echo "\" />\r\n\t\t\t\t</form>\r\n\t\t\t\t<script>\r\n\t\t\t\t\twindow.onload = function() {\r\n\t\t\t\t\t\tdocument.getElementById('landing').submit();\r\n\t\t\t\t\t}\r\n\t\t\t\t</script>\r\n\t\t\t</body>\r\n\r\n\t\t\t</html>\r\n\t\t";
                    exit;
            }
        } else {
            if ($url[1] == $wpsaf->permalink1 && $url[2] != "" && $wpsaf->permalink == 1 || $_GET[$wpsaf->permalink2] != "" && $wpsaf->permalink == 2 || 0 < count($_GET) && !isset($_GET[$wpsaf->permalink2]) && !isset($_GET["safelink_redirect"]) && ($wpsaf->permalink == 4 || $wpsaf->permalink == 3) || isset($_POST["go"])) {
                if (isset($_POST["go"])) {
                    $safe_id = trim(urldecode($_POST["go"]));
                } else {
                    if ($wpsaf->permalink == 1) {
                        $safe_id = $url[2];
                    } else {
                        if ($wpsaf->permalink == 2) {
                            $safe_id = trim(urldecode($_GET[$wpsaf->permalink2]));
                        } else {
                            list($safe_id) = explode("?", $urls);
                        }
                    }
                }
                if (strlen($safe_id) == 8) {
                    $sql = "SELECT * FROM " . $wpdb->prefix . "wpsafelink WHERE safe_id='" . $safe_id . "'";
                    $cek = $wpdb->get_results($sql, "ARRAY_A");
                    $safe_link = urlencode($cek[0]["link"]);
                } else {
                    $safe_link = urlencode(base64_decode($safe_id));
                }
                if ($safe_link != "") {
                    $sql = "SELECT * FROM " . $wpdb->prefix . "wpsafelink WHERE link='" . urldecode($safe_link) . "'";
                    $cek = $wpdb->get_results($sql, "ARRAY_A");
                    if ($cek) {
                        $data = ["date_view" => date("Y-m-d H:i:s"), "view" => $cek[0]["view"] + 1];
                        $wpdb->update($wpdb->prefix . "wpsafelink", $data, ["ID" => $cek[0]["ID"]]);
                    } else {
                        if ($wpsaf->autosave == 1) {
                            $linkd = urldecode($safe_link);
                            $safeid = substr(md5($linkd . date("His")), 2, 8);
                            $data = ["date" => date("Y-m-d H:i:s"), "safe_id" => $safeid, "link" => $linkd];
                            $wpdb->insert($wpdb->prefix . "wpsafelink", $data, "");
                        }
                    }
                }
                if ($wpsaf->content == "0") {
                    $args = ["post_type" => "post", "orderby" => "rand", "posts_per_page" => 1];
                    $the_query = new WP_Query($args);
                    if ($the_query->have_posts()) {
                        while ($the_query->have_posts()) {
                            $the_query->the_post();
                        }
                    }
                } else {
                    if ($wpsaf->content == "1") {
                        $ID = explode(",", $wpsaf->contentid);
                        shuffle($ID);
                        foreach ($ID as $id) {
                            $posts = get_post($id);
                            setup_postdata($GLOBALS["post"] =& $posts);
                        }
                    }
                }
                $_GET["ads1"] = $wpsaf->ads1;
                $_GET["ads2"] = $wpsaf->ads2;
                $_GET["ads3"] = $wpsaf->ads3;
                $_GET["ads4"] = $wpsaf->ads4;
                $_GET["logo"] = $wpsaf->logo;
                $_GET["image1"] = $wpsaf->image1;
                $_GET["image2"] = $wpsaf->image2;
                $_GET["image3"] = $wpsaf->image3;
                $_GET["delaytext"] = str_replace("{time}", "<span id=\"wpsafe-time\">" . $wpsaf->delay . "</span>", $wpsaf->delaytext);
                $_GET["delay"] = $wpsaf->delay;
                $_GET["adb"] = $wpsaf->adb;
                $_GET["adb1"] = $wpsaf->adb1;
                $_GET["adb2"] = $wpsaf->adb2;
                $safe_link = ["second_safelink_url" => $wpsaf->second_safelink_url, "safelink" => $safe_link];
                $safe_link = json_encode($safe_link);
                $_GET["linkr"] = home_url() . "?safelink_redirect=" . base64_encode($safe_link);
                $code = base64_encode(json_encode($_GET));
                $_GET["code"] = $code;
                if ($wpsaf->newsafelink == "on") {
                    $page_template = dirname(__FILE__) . "/template/template2.php";
                } else {
                    if (!isset($_POST["newwpsafelink"])) {
                        $page_template = dirname(__FILE__) . "/template/" . $wpsaf->template . ".php";
                    }
                }
            } else {
                if ($_GET["safelink_redirect"] != "") {
                    $safelink_redirect = json_decode(base64_decode($_GET["safelink_redirect"]), true);
                    $link = $safelink_redirect["safelink"];
                    $link = urldecode(urldecode(trim($link)));
                    $sql = "SELECT * FROM " . $wpdb->prefix . "wpsafelink WHERE link='" . $link . "'";
                    $cek = $wpdb->get_results($sql, "ARRAY_A");
                    if ($cek) {
                        $click = $cek[0]["click"] + 1;
                        $data = ["date_click" => date("Y-m-d H:i:s"), "click" => $click];
                        $wpdb->update($wpdb->prefix . "wpsafelink", $data, ["ID" => $cek[0]["ID"]]);
                    }
                    if (!empty($safelink_redirect["second_safelink_url"])) {
                        $link = $safelink_redirect["second_safelink_url"] . "?wpsafelink=" . $safelink_redirect["safelink"] . "&redir=" . base64_encode($safelink_redirect["second_safelink_url"]);
                    }
                    wp_redirect($link);
                    exit;
                }
                if ($url[1] == "wpsafelinkk.js") {
                    header("Content-type: application/javascript");
                    echo "\t\t\tvar wpsafelink = 'http://themeson.dev/go/';\r\n\t\t\tvar els = document.getElementsByTagName(\"a\");\r\n\t\t\tfor(var i = 0, l = els.length; i < l; i++) { var el=els[i]; el.href=wpsafelink + btoa(el.href); } \r\n\t\t\t";
                    exit;
                }
            }
            return $page_template;
        }
    }
    public function wp_safelink_options()
    {
        global $wpdb;
        if (0 < $_GET["delete"]) {
            $wpdb->delete($wpdb->prefix . "wpsafelink", ["ID" => $_GET["delete"]], "");
        } else {
            if ($_POST["save"] == "Save") {
                $wpsaf = $_POST["wpsaf"];
                $wpsaf = array_map("stripslashes", $wpsaf);
                $wpsaf = json_encode($wpsaf);
                update_option("wpsaf_options", $wpsaf);
                $wpsaf = json_decode(get_settings("wpsaf_options"));
                $dom = explode(PHP_EOL, $wpsaf->domain);
                $dom = array_map("trim", $dom);
                $dom = array_map("strtolower", $dom);
                $dm = "";
                $rep = ["https://", "http://", "www."];
                foreach ($dom as $d) {
                    $dm .= "\"" . $d . "\",";
                }
                $dom_exclude = explode(PHP_EOL, $wpsaf->exclude_domain);
                $dom_exclude = array_map("trim", $dom_exclude);
                $dom_exclude = array_map("strtolower", $dom_exclude);
                $dm_exclude = "";
                $rep = ["https://", "http://", "www."];
                foreach ($dom_exclude as $d) {
                    $dm_exclude .= "\"" . $d . "\",";
                }
                $domain = empty($wpsaf->base_url) ? home_url() : $wpsaf->base_url;
                $domain = substr($domain, -1) != "/" ? $domain . "/" : $domain;
                if ($wpsaf->permalink == 1) {
                    $safe_link = $domain . $wpsaf->permalink1 . "/";
                } else {
                    if ($wpsaf->permalink == 2) {
                        $safe_link = $domain . "?" . $wpsaf->permalink2 . "=";
                    } else {
                        $safe_link = home_url() . "?";
                    }
                }
                $js = "";
                $js .= $wpsaf->redirect == 1 ? "var redirUrl = \"" . $domain . "\";" : "var redirUrl = \"\";";
                $js .= "\r\n\t\t\t\tvar wpsafelink = \"" . $safe_link . "\";\r\n\t\t\t\tvar domain = [" . rtrim($dm, ",") . "];\r\n\t\t\t\tvar exclude_domain = [" . rtrim($dm_exclude, ",") . "];\r\n\t\t\t\tvar els = document.getElementsByTagName(\"a\"); \r\n\t\t\t\tfor(var i = 0, l = els.length; i < l; i++) {\t\r\n\t\t\t\t\tvar el = els[i]; \r\n\t\t\t\t\tvar li = el.href;\r\n\t\t\t\t\t\r\n\t\t\t\t\tif( exclude_domain.length > 0 && exclude_domain[0] != \"\" ) {\r\n\t\t\t\t\t\tvar exists = false;\r\n\t\t\t\t\t\tfor(var d=0; d < exclude_domain.length; d++){\r\n\t\t\t\t\t\t\tif(li.includes(exclude_domain[d])){\r\n\t\t\t\t\t\t\t\texists = true;\r\n\t\t\t\t\t\t\t}\r\n\t\t\t\t\t\t}\r\n\t\t\t\t\t\tif( !exists ) {\r\n\t\t\t\t\t\t\tel.target = \"_blank\";\r\n\t\t\t\t\t\t\tif( !wpsafelink.includes(\"?\") ) {\r\n\t\t\t\t\t\t\t\tel.href = wpsafelink + btoa(el.href) + \"?redir=\" + btoa(redirUrl);\r\n\t\t\t\t\t\t\t} else {\r\n\t\t\t\t\t\t\t\tel.href = wpsafelink + btoa(el.href) + \"&redir=\" + btoa(redirUrl);\r\n\t\t\t\t\t\t\t}\r\n\t\t\t\t\t\t}\r\n\t\t\t\t\t} else if(domain.length > 0 && domain[0] != \"\") {\r\n\t\t\t\t\t\tfor(var d=0; d < domain.length; d++){\r\n\t\t\t\t\t\t\tif(li.includes(domain[d])){\r\n\t\t\t\t\t\t\t\tel.target = \"_blank\";\r\n\t\t\t\t\t\t\t\tif( !wpsafelink.includes(\"?\") ) {\r\n\t\t\t\t\t\t\t\t\tel.href = wpsafelink + btoa(el.href) + \"?redir=\" + btoa(redirUrl);\r\n\t\t\t\t\t\t\t\t} else {\r\n\t\t\t\t\t\t\t\t\tel.href = wpsafelink + btoa(el.href) + \"&redir=\" + btoa(redirUrl);\r\n\t\t\t\t\t\t\t\t}\r\n\t\t\t\t\t\t\t}\r\n\t\t\t\t\t\t}\r\n\t\t\t\t\t}\r\n\t\t\t\t}";
                file_put_contents(ABSPATH . "/wpsafelink.js", $js);
                echo "<div id=\"message\" class=\"updated fade\"><p><strong>Settings have been saved</strong></p></div>";
            } else {
                if ($_POST["reset"] == "Reset") {
                    wpsaf_default();
                    echo "<div id=\"message\" class=\"updated fade\"><p><strong>Settings have been reset</strong></p></div>";
                }
            }
        }
        $wpsaf = json_decode(get_settings("wpsaf_options"));
        if ($_POST["generate"] == "Generate" && trim($_POST["linkd"]) != "") {
            $linkd = trim($_POST["linkd"]);
            $safe_id = substr(md5($linkd . date("His")), 2, 8);
            $sql = "SELECT * FROM " . $wpdb->prefix . "wpsafelink WHERE link='" . $linkd . "'";
            $cek = $wpdb->get_results($sql, "ARRAY_A");
            if (!$cek) {
                $data = ["date" => date("Y-m-d H:i:s"), "safe_id" => $safe_id, "link" => $linkd];
                $wpdb->insert($wpdb->prefix . "wpsafelink", $data, "");
            } else {
                $linkd = $cek[0]["link"];
                $safe_id = $cek[0]["safe_id"];
            }
            if ($wpsaf->permalink == 1) {
                $generated3 = home_url() . "/" . $wpsaf->permalink1 . "/" . $safe_id;
                $generated2 = home_url() . "/" . $wpsaf->permalink1 . "/" . base64_encode($linkd);
            } else {
                if ($wpsaf->permalink == 2) {
                    $generated3 = home_url() . "/?" . $wpsaf->permalink2 . "=" . $safe_id;
                    $generated2 = home_url() . "/?" . $wpsaf->permalink2 . "=" . base64_encode($linkd);
                } else {
                    $generated2 = home_url() . "/?" . base64_encode($linkd);
                    $generated3 = home_url() . "/?" . $safe_id;
                }
            }
        }
        $sql = "SELECT * FROM " . $wpdb->prefix . "wpsafelink order by date desc";
        $safe_lists = $wpdb->get_results($sql, "ARRAY_A");
        if ($_POST["sub"] == "Change License") {
            $cached = WPSAF_DIR . "assets/wpsaf.script.js";
            if (file_exists($cached)) {
                unlink($cached);
            }
        }
        if ($_POST["lisensi"] && $_POST["submit"] == "Validate License") {
            $lis = $_POST["lisensi"];
            if (strlen($lis) != 29) {
                echo "<div id=\"message\" class=\"error\"><p><strong>Invalid license.</strong></p></div>";
            } else {
                $cek = $this->ceklis($lis);
                if ($cek) {
                    echo "<div id=\"message\" class=\"updated fade\"><p><strong>activation license successfully</strong></p></div>";
                } else {
                    echo "<div id=\"message\" class=\"error\"><p><strong>Invalid license.</strong></p></div>";
                }
            }
        }
        $cek = $this->ceklis();
        $wphar = json_decode(get_option("wphar_setting"));
        $domen = str_replace(["https://", "http://"], "", home_url());
        include WPSAF_DIR . "droplink.options.php";
    }
    public function ceklis($lis = "", $get_license = false)
    {
        $cached = WPSAF_DIR . "assets/wpsaf.script.js";
        $domen = str_replace(["https://", "http://"], "", home_url());
        if (file_exists($cached)) {
            $cek = $lis;
            $time = filemtime($cached);
            $time = date("Y-m-d H:i:s", $time);
            $awal = date_create($time);
            $akhir = date_create();
            $diff = date_diff($awal, $akhir);
            $filecached = file_get_contents($cached);
            $filecached = substr($filecached, 29, 9999);
            $filecached = json_decode(base64_decode($filecached));
            if ($lis == "" && $filecached->msg->domain == $domen) {
                $lis = $filecached->msg->license;
            }
            if ($cek == "key") {
                return substr($filecached->msg->license, 0, 10) . "*********";
            }
            if ($get_license) {
                return $lis;
            }
            if ($diff->h <= 0 && $diff->i <= 1 && $filecached->status == "sakses" && $filecached->msg->domain == $domen) {
                return true;
            }
        }
        if ($lis != "") {
            $satu = base64_decode(substr("dxaHR0cHM6Ly9hcGkudGhlbWVzb24uY29t", 2, 999));
            $dua = base64_decode(substr("dxL3RoZW1lc29uX2xpY2Vuc2U=", 2, 999));
            $tiga = base64_decode(substr("dxL3dwc2FmZWxpbmsv", 2, 999));
            $link = $satu . $dua . $tiga . $lis . "/" . base64_encode($domen);
            $cek = json_decode($this->get_curl($link));
            if ($cek->status == "sakses" && $cek->msg->license == $lis) {
                $res = json_encode($cek);
                $res = base64_encode($res);
                $res = substr($res, 1, 29) . $res;
                file_put_contents($cached, $res);
                return true;
            }
        }
        return false;
    }
    public function ceks()
    {
        if (!$this->ceklis()) {
            echo "<script> location.replace(\"admin.php?page=droplink&tb=lic\"); </script>";
            exit;
        }
        return true;
    }
    public function get_curl($url)
    {
        $response = wp_remote_get($url);
        if (!is_wp_error($response)) {
            $body = $response["body"];
            return $body;
        }
        return false;
    }
    public function foot_admin()
    {
        if ($_GET["page"] == "droplink") {
        }
    }
    public function footer_wp_safelink()
    {
        echo "<script src=\"" . get_bloginfo("url") . "/wpsafelink.js\"></script>";
    }
}
function newwpsafelink_bottom()
{
    $code = $_GET["newsafelink"];
    if ($code) {
        $code["ads3"] = stripslashes($code["ads3"]);
        $code["ads4"] = stripslashes($code["ads4"]);
        echo " \r\n\t\t";
    }
}

function newwpsafelink_top()
{
    $code = $_GET["newsafelink"];
    if ($code) {
        $wpsaf = json_decode(get_settings("wpsaf_options"));
        $code["delaytext"] = stripslashes(str_replace("<span id=\\\"wpsafe-time\\\">", "<span id=\"wpsafe-time\">", $code["delaytext"]));
        $code["ads1"] = stripslashes($code["ads1"]);
        $code["ads2"] = stripslashes($c

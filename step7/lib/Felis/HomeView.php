<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/11/17
 * Time: 9:31 PM
 */

namespace Felis;


class HomeView extends View {
    /**
     * Constructor
     * Sets the page title and any other settings.
     */
    public function __construct() {
        $this->setTitle("Felis Investigations");
        $this->addLink("login.php", "Log in");
    }

    /**
     * Add content to the header
     * @return string Any additional comment to put in the header
     */
    protected function headerAdditional() {
        return <<<HTML
<p>Welcome to Felis Investigations!</p>
<p>Domestic, divorce, and carousing investigations conducted without publicity. People and cats shadowed
	and investigated by expert inspectors. Katnapped kittons located. Missing cats and witnesses located.
	Accidents, furniture damage, losses by theft, blackmail, and murder investigations.</p>
<p><a href="">Learn more</a></p>
HTML;
    }


    public function addTestimonial($testimonial, $name){
        $this->testimonials_arr[] = $testimonial;
        $this->names[] = $name;
    }

    public function testimonials(){
        $html = '';
        $left = '<div class="left">';
        $right = '<div class="right">';
        $html .= "<section class=\"testimonials\">
    <h2>TESTIMONIALS</h2>";
        for($i = 0; $i < count($this->testimonials_arr); $i++){
            $testimonial = $this->testimonials_arr[$i];
            $name = $this->names[$i];
            if($i % 2 == 0) {
                $left .= "<blockquote><p>$testimonial</p><cite>$name</cite></blockquote>";
            }
            else{ $right .= "<blockquote><p>$testimonial</p><cite>$name</cite></blockquote>";}
        }
        $left .= "</div>";
        $right .= "</div>";
        $html .= "$left";
        $html .= "$right";
        $html .= "</section>";
        return $html;
    }


    private $testimonials_arr = array(); // should this be protected or private?
    private $names = array();
}
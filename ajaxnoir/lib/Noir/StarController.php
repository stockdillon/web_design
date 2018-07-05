<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/25/17
 * Time: 8:45 PM
 */

namespace Noir;


class StarController extends Controller {
    /**
     * StarController constructor.
     * @param Site $site Site object
     * @param $user User object
     * @param array $post $_POST
     */
    public function __construct(Site $site, $user, $post) {
        parent::__construct($site);
        $root = $site->getRoot();

        $id = strip_tags($post['id']);
        $rating = strip_tags($post['rating']);
        $movies = new Movies($site);
        $ret = $movies->updateRating($user, $id, $rating);
        $homeView = new HomeView($site, $user);
        $table = $homeView->presentTable();
        //var_dump($ret);
        if($ret){
            $this->result = json_encode(array('ok' => true, 'table' => $table));
            //var_dump($this->result);
            return;
        }
        else{
            $this->result = json_encode(array('ok' => false, 'message' => "Failed to update database!"));
            return;
        }
    }
}
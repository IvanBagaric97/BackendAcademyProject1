<?php


namespace controller;
use view, Dispatch, lib, db;

class ViewCommentController extends AbstractController
{
    public function doAction(): void
    {
        $id = Dispatch\Dispatcher::getInstance()->getRoute()->getParam('quiz_id');
        $a = new db\DBDriver();

        $enable_comments = $a -> get_quiz_by_id($id)["enable_comments"];

        $all_comments = $a -> get_comments_by_id($id);
        $comments = [];
        foreach($all_comments as $com){
            array_push($comments, [$a -> get_user_by_id($com["user_id"])["name"], $com["content"]]);
        }

        $h = new view\CommentsView($id, $comments, $enable_comments);
        $h -> generateHTML();
    }
}
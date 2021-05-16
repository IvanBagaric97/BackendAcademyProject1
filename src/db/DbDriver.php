<?php

namespace db;
use \PDO;


class DBDriver
{
    private PDO $db;

    public function __construct()
    {
        $a = new DBPool();
        $this->db = $a -> getInstance();
    }

    /**
     * Unesi novi red u bazu
     * @param string $file
     * @param string $row
     */
    function insert(string $file, string $row): void
    {
        $current = file_get_contents($file);
        $current .= trim($row) . "\n";
        file_put_contents($file, $current, LOCK_EX);
    }

    /**
     * Iz baze uklanja redak s odabranim id-om
     * @param string $table
     * @param string $id
     */
    function delete(string $table, string $id): void
    {
        $sql = "DELETE FROM " . $table ." WHERE id=?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array($id));
    }

    /**
     * Vraća redak sa zadanim id-im ili vraća sve retke ako je id == null
     * @param string $table
     * @param string|null $id
     * @return array
     */
    function select(string $table, ?string $id = null): array
    {
        $ret = [];

        if ($id === null) {
            $sql = "SELECT * FROM " . $table;
        }else {
            $sql = "SELECT * FROM " . $table . " WHERE id=" . $id;
        }
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        foreach($stmt as $row){
            $pom = [];
            foreach($row as $item){
                array_push($pom, $item);
            }
            array_push($ret, $pom);
        }
        if($id === null){
            return $ret;
        }else{
            return $ret[0];
        }
    }

    /**
     * Vraca listu filmova cije ime pocinje sa zadanim slovom
     * @param string $letter
     * @return array
     */
    function startsWithLetter(string $letter): array
    {
        $ret = [];

        $sql = "SELECT * FROM films.film WHERE name LIKE " . "'" . $letter . "%'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        foreach($stmt as $row){
            $pom = [];
            foreach($row as $item){
                array_push($pom, $item);
            }
            array_push($ret, $pom);
        }

        return $ret;
    }

    function createNewMovie(string $name, int $genre_id, int $year, int $duration, string $cover) : void {
        $sql = "INSERT INTO films.film (name, id_genre, year, duration, cover)
                VALUES (:ime, :g_id, :godina, :trajanje, :art)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([":ime"=>$name, ":g_id"=>$genre_id, ":godina"=>$year, ":trajanje"=>$duration, ":art"=>$cover]);
    }

    function getGenreId(string $genre) : ?int {
        $sql = "SELECT id FROM genre WHERE name=?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array($genre));
        return $stmt->fetch()->id ?? null;
    }

    function getGenres() : array {
        $ret = [];
        $sql = "SELECT name FROM genre";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        foreach($stmt as $row){
            foreach($row as $item){
                array_push($ret, $item);
            }
        }
        return $ret;
    }

    function getImage(string $id)
    {
        $sql = "SELECT cover FROM film WHERE id=?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array($id));
        return $stmt->fetch()->cover ?? null;
    }

    function get_user_by_email(string $email, string $password) : ?array{
        $sql = "SELECT * FROM user WHERE email = :username AND password = :password";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([":username" => $email, ":password" => $password]);
        $x = $stmt->fetch();
        if(!$x){
            return null;
        }else{
            return ["name" => $x -> name, "surname" => $x -> surname, "email" => $x -> email, "password" => $x-> password];
        }
    }

    function exists(string $email) : Bool{
        $sql = "SELECT * FROM user WHERE email=?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array($email));
        $x = $stmt->fetch();
        return (bool)$x;
    }

    function quiz_exists(string $name) : Bool{
        $sql = "SELECT * FROM quiz WHERE name=?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array($name));
        $x = $stmt->fetch();
        return (bool)$x;
    }

    function set_new_user($name, $surname, $date, $email, $password) : void{
        $sql = "INSERT INTO user (name, surname, date_of_birth, email, password)
                VALUES (:name, :surname, :date_of_birth, :email, :password)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([":name"=>$name, ":surname"=>$surname, ":date_of_birth"=>$date, ":email"=>$email,
                ":password"=>$password]);
    }

    function get_user_id(string $email) : ?int{
        $sql = "SELECT id FROM user WHERE email=?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array($email));
        return $stmt->fetch()->id ?? null;
    }

    function get_user_by_id($id) : ?array{
        $sql = "SELECT * FROM user WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array($id));
        $x = $stmt->fetch();
        if(!$x){
            return null;
        }else{
            return ["name" => $x -> name, "surname" => $x -> surname, "email" => $x -> email,
                "date_of_birth" => $x -> date_of_birth, "password" => $x -> password];
        }
    }

    function edit_user($id, $new_date, $new_email, $new_password){
        $sql = "UPDATE User SET date_of_birth = :date, email = :email, password = :password WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["id"=>$id, ":date"=>$new_date, ":email"=>$new_email, ":password"=>$new_password]);
    }

    function set_new_quiz($name, $description, $file, $isPublic, $comments) : void{
        $sql = "INSERT INTO quiz (name, description, qref_file, is_public, enable_comments, created_user_id)
                VALUES (:name, :description, :qref_file, :is_public, :enable_comments, :created_user_id)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([":name"=>$name, ":description"=>$description, ":qref_file"=>$file,
            ":is_public"=>$isPublic, ":enable_comments"=>$comments, ":created_user_id"=>$_SESSION["id"]]);
    }

    function set_new_quiz_answers($quiz_id, $user_id, $points, $qref_answers) : void{
        $sql = "INSERT INTO user_question_answers (quiz_id, user_id, points, qref_answers)
                VALUES (:quiz_id, :user_id, :points, :qref_answers)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([":quiz_id"=>$quiz_id, ":user_id"=>$user_id, ":points"=>$points,
                    ":qref_answers"=>$qref_answers]);
    }

    function set_new_comment($content, $quiz_id, $user_id) : void{
        $sql = "INSERT INTO comment (content, quiz_id, user_id)
                VALUES (:content, :quiz_id, :user_id)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(["content"=>$content, ":quiz_id"=>$quiz_id, ":user_id"=>$user_id]);
    }

    function get_quizzes() : array{
        $ret = [];
        $sql = "SELECT * FROM quiz";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $x = $stmt->fetchAll();

        foreach($x as $row){
            array_push($ret, ["id" => $row -> id, "name" => $row -> name, "description" => $row -> description,
                "is_public" => $row -> is_public, "enable_comments" => $row -> enable_comments,
                "created_user_id" => $row -> created_user_id]);
        }
        return $ret;
    }

    function get_answers() : array {
        $ret = [];
        $sql = "SELECT * FROM user_question_answers";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $x = $stmt->fetchAll();

        foreach($x as $row){
            array_push($ret, ["quiz_id" => $row -> quiz_id, "user_id" => $row -> user_id,
                "points" => $row -> points, "qref_answers" => $row -> qref_answers]);
        }
        return $ret;
    }

    function get_quiz_by_id($id) : ?array{
        $sql = "SELECT * FROM quiz WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array($id));
        $x = $stmt->fetch();
        if(!$x){
            return null;
        }else{
            return ["name" => $x -> name, "description" => $x -> description, "qref_file" => $x -> qref_file,
                "is_public" => $x -> is_public, "enable_comments" => $x -> enable_comments, "created_user_id" => $x -> created_user_id];
        }
    }

    function get_quiz_answ_by_user_id($id) : array{
        $ret = [];
        $sql = "SELECT * FROM user_question_answers WHERE user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array($id));
        $x = $stmt->fetchAll();

        foreach($x as $row){
            array_push($ret, ["quiz_id" => $row -> quiz_id, "user_id" => $row -> user_id,
                "points" => $row -> points, "qref_answers" => $row -> qref_answers]);
        }
        return $ret;
    }

    function get_comments_by_id($id) : array{
        $ret = [];
        $sql = "SELECT * FROM comment WHERE quiz_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array($id));
        $x = $stmt->fetchAll();

        foreach($x as $row){
            array_push($ret, ["content" => $row -> content, "quiz_id" => $row -> quiz_id,
                "user_id" => $row -> user_id]);
        }
        return $ret;
    }
}
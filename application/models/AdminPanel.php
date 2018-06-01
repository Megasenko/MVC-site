<?php
/**
 * Created by PhpStorm.
 * User: megas
 * Date: 30.05.18
 * Time: 20:54
 */

class AdminPanel extends ModelBlog
{

    public function getArticles()
    {
        if ($this->connect()) {


            $sql = "SELECT articles.*, users.login AS authorLogin
                FROM articles 
                INNER JOIN users ON users.id = articles.author 
                ";

            return $this->connect()->query($sql)->fetchAll(PDO::FETCH_OBJ);
        }

        return false;
    }

    public function delImage($filePath)
    {
        if ($filePath != null) {
            if (file_exists($filePath)) {
                return unlink(__DIR__ . '/../../' . $filePath);
            }
            return false;
        }
    }

    public function updateByUrl($url, $postRequest)
    {
        $filePath = null;
        if (isset($_FILES)) {
            $filePath = $this->saveImage();
        }
        if ($filePath != null) {
            $article = $this->getArticleByUrl($url);
            if ($article['image']) {
                unlink(__DIR__ . '/../../' . $article['image']);
            }
        }
        $title = $postRequest["title"];
        $content = $postRequest["content"];
        $sql = "UPDATE posts SET title='$title', content='$content', image='$filePath' 
                WHERE url='$url'";
        if (mysqli_query($this->connect(), $sql)) {
            return true;
        } else {
            return mysqli_error($this->connect());
        }
    }


}
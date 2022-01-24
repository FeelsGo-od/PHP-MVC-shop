<?php 

    class News {
        // Returns single news item with specified id
        public static function getNewsItemById($id) {
            $id = intval($id);

            if($id) {
                // $host = 'localhost';
                // $dbname = 'mvc_site';
                // $user = 'root';
                // $password = '';
                // $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

                $db = Db::getConnection();

                $result = $db->query('SELECT * FROM news WHERE id='. $id);

                $result->setFetchMode(PDO::FETCH_ASSOC);

                $newsItem = $result->fetch();
                return $newsItem;
            }
        }

        // Returns array of news items
        public static function getNewsList() {
            // $host = 'localhost';
            // $dbname = 'mvc_site';
            // $user = 'root';
            // $password = '';
            // $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

            $db = Db::getConnection();


            $newsList = array();

            $result = $db->query('SELECT id, title, date, short_content, author_name FROM news ORDER BY date DESC LIMIT 10');

            $i = 0;
            while ($row = $result->fetch()) {
                $newsList[$i]['id'] = $row['id'];
                $newsList[$i]['title'] = $row['title'];
                $newsList[$i]['author_name'] = $row['author_name'];
                $newsList[$i]['date'] = $row['date'];
                $newsList[$i]['short_content'] = $row['short_content'];
                $i++;
            }
            
            return $newsList;
        }      
    }
?>
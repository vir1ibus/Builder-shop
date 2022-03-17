<section class="main-content">
	<div class="container-fluid">
		<div class="row">
            <?php
                $category = mysqli_escape_string($connect_db, $_GET['category']);
                $sql = "SELECT * FROM `characteristics` WHERE `characteristics`.`id` IN 
                              (SELECT `characteristics_id` FROM `item_has_characteristics` WHERE item_id IN 
                                                                                                 (SELECT id FROM item WHERE category_id = ${_GET['category']}));";
                $result_name_char = mysqli_query($connect_db, $sql);

                $_SESSION['characteristics'] = array();
                if(mysqli_num_rows($result_name_char)) {
                    while ($row_name_char = mysqli_fetch_array($result_name_char)) {
                        $sql = "SELECT `value` FROM item_has_characteristics WHERE characteristics_id = ${row_name_char['id']}";
                        $result_val_char = mysqli_query($connect_db, $sql);
                        while ($row_val_char = mysqli_fetch_array($result_val_char)) {
                            $_SESSION['characteristics'][$row_name_char['id']][] = $row_val_char['value'];
                        }
                    }
                }

                if(isset($_GET['search'])) {
                    $_SESSION['search'] = $_GET['search'];
                } else {
                    $_SESSION['search'] = '';
                }

                $search = mysqli_real_escape_string($connect_db, $_SESSION['search']);

                $filters = array();
                foreach($_SESSION['characteristics'] as $id => $values) {
                    if(isset($_GET[$id])) {
                        if(is_array($_GET[$id])) {
                            foreach ($_GET[$id] as $value) {
                                $_SESSION['selected'][$id][] = $value;
                                $filters[] = "(characteristics_id = ${id} AND value = '${value}')";
                            }
                        } else {
                            $_SESSION['selected'][$id] = $_GET[$id];
                        }
                    }
                }
                if(!empty($filters)) {
                    $sql = "SELECT * FROM item WHERE (category_id=${category} AND name LIKE '%${search}%') AND id IN (SELECT item_id FROM item_has_characteristics WHERE " . implode(" OR ", $filters) . ");";
                } else {
                    $sql = "SELECT * FROM item WHERE (category_id=${category} AND name LIKE '%${search}%')";
                }

                $result_items = mysqli_query($connect_db, $sql);

                if(isset($_SESSION['selected'])) {
                    $selected = $_SESSION['selected'];
                }

                if(!empty($_SESSION['characteristics'])) {
                    echo "<div class=\"col-xl-2 col-lg-3 col-sm-4\">
                            <div class=\"row justify-content-center\">
                                <button class=\"d-sm-none btn btn-secondary w-75\" type=\"button\" data-bs-toggle=\"collapse\" aria-expanded=\"true\" data-bs-target=\"#collapseFilters\" aria-controls=\"collapseFilters\">
                                    Фильтры
                                </button>
                            </div>
                            <div class=\"collapse\" id=\"collapseFilters\">
                            <form action=\"index.php\" method=\"GET\" id=\"search-filters\">
                                <input type=\"hidden\" name=\"page\" value=\"itemspage\">
                                <input type=\"hidden\" name=\"category\" value=\"${_GET['category']}\">";
                    foreach ($_SESSION['characteristics'] as $id => $values){
                        $sql = "SELECT name FROM characteristics WHERE id = ".$id.";";
                        $result = mysqli_query($connect_db, $sql);
                        $row = mysqli_fetch_array($result);
                        echo "<h5 class=\"text-center\">".$row['name']."</h5>";
                        foreach ($values as $key => $value) {
                            $checked = '';
                            if(isset($selected)) {
                                if(array_key_exists($id, $selected)) {
                                    if(is_array($selected[$id])) {
                                        if(in_array($value, $selected[$id])) {
                                            $checked = "checked";
                                        }
                                    } else if($selected[$id] == $value) {
                                        $checked = "checked";
                                    }
                                }
                            }
                            echo "<div class=\"form-check\">
                                    <input class=\"form-check-input\" type=\"checkbox\" name=\"${id}[]\" value=\"${value}\" ${checked}>
                                    <label class=\"form-check-label\">
                                        ${value}
                                    </label>
                                  </div>";
                        }
                        echo "<br>";
                    }
                    echo "
                                <div class=\"row justify-content-center\">
                                    <button class=\"btn btn-primary w-75\" type=\"submit\">Применить</button>
                                </div>
                            </form>
                            </div>
                        </div>
                        <div class=\"col-xl-10 col-lg-9 col-sm-8\">
                        ";
                } else {
                    echo "<div>";
                }

                echo "<div class=\"d-flex search-box\">
                          <input form=\"search-filters\" class=\"form-control me-2\" type=\"search\" name=\"search\" value=\"${_SESSION['search']}\" placeholder=\"Search\" aria-label=\"Search\">
                          <button form=\"search-filters\" class=\"btn btn-primary\" type=\"submit\">
                              <i class=\"fas fa-search\"></i>
                          </button>
                      </div>";

                unset($_SESSION['search'], $_SESSION['selected'], $selected);
            ?>
            <div class="container product-cards">
                <div class="row d-flex justify-content-center">
                    <?php
                    if(!$result_items) {
                            echo "<p>Произошла ошибка при выполнении запроса</p>";
                    } else {
                        if (mysqli_num_rows($result_items) == 0) {
                            echo "<div class=\"text-center\">
                                    <h3>Ничего не найдено</h3>
                                  </div>";
                        } else {
                            while ($row = mysqli_fetch_array($result_items)) {
                                echo "<div class=\"col-xl-4 col-lg-6 col-sm-12 d-flex justify-content-center\">
                                          <div class=\"product-card\">
                                              <div class=\"product-thumb\">
                                                  <a href=\"index.php?page=iteminfopage&item=${row['id']}\"><img src=\"${row['image']}\" alt=\"\"></a>
                                              </div>
                                              <div class=\"product-details\">
                                                  <h5><a href=\"index.php?page=iteminfopage&item=${row['id']}\">${row['name']}</a></h5>
                                                  <div class=\"product-bottom-details d-flex justify-content-between\">
                                                      <div class=\"product-price\">
                                                          ${row['price']} руб.
                                                      </div>
                                                      <div class=\"product-links\">
                                                          <a href=\"#\"><button type=\"submit\" class=\"fas fa-shopping-cart\"></button></a>
                                                          <a href=\"#\"><button class=\"far fa-heart\"></button></a>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>";
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
</section>
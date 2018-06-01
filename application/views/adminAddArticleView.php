<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/adminPanel">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Add article</li>
        </ol>


        <!-- Example DataTables Card-->
        <div class="row">
            <div class="col-12">
                <form method="post" action="addArticle" enctype="multipart/form-data">
                    <label class="container">
                        Заголовок
                        <input size="101px" type="text" name="title" value="" class="form-item" autofocus required>
                    </label>

                    <label class="container">
                        Добавить картинку
                        <input type="file" name="image"  class="form-item">
                    </label>

                    <label class="container">
                        Краткое описание
                        <textarea rows="2" cols="100" type="text" name="sub_title"  class="form-item" required></textarea>
                    </label>

                    <label class="container">
                        Содержимое статьи
                        <textarea rows="10" cols="100" type="text" name="content"  class="form-item" required></textarea>
                    </label>

                    <br>
                    <button style="margin: 15px" type="submit" name="add" class="btn btn-success" >Добавить запись</button>
                </form>
            </div>


        </div>
    </div>
    <!-- /.container-fluid-->
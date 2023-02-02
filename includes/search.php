<div class="card mb-4">

    <div class="card-header">Search</div>
    <form action="search_engine.php" method="post">
        <div class="card-body">
            <div class="input-group">
                <input class="form-control" type="text" name="search" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                <button class="btn btn-primary" id="button-search" type="submit" name="submit">Go!</button>
            </div>
        </div>
    </form>
</div>

<!-- Login Form -->
<div class="card mb-4">
    <div class="card-header">Login</div>
    <form action="includes/login.php" method="post">
        <div class="card-body">
            <div class="input-group">
                <input class="form-control" type="text" name="username" placeholder="Username"/>
            </div>
            <div class="input-group">
                <input class="form-control" type="password" name="password" placeholder="Password"/>
            </div>
            <button class="btn btn-primary" id="button-search" type="submit" name="submit">Login</button>
        </div>
    </form>
</div>
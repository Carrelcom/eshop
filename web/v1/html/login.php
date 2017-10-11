<!-- /.apple devices image -->
<div class="col-md-10 col-md-offset-1">
    <p>
        Inscription
    </p>
    <form method="POST" id="contact-form" class="form-horizontal" action="engine.php?action=login" onSubmit="alert( 'Thank you for your feedback!' );">

        <div class="form-group">
            <input type="text" name="Mail" id="Mail" class="form-control" placeholder="Your email" required/>
        </div>

        <div class="form-group">
            <input type="password" name="Pwd" id="Pwd" class="form-control" placeholder="¨Password" required/>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Add" class="btn btn-success" />
        </div>
    </form>

    <div class="text-center"><a href="index.html">Back to Main Page</a></div>
</div>

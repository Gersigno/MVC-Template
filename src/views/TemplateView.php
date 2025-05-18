<h2>Template page</h2>
<h3><i>(TemplateController)</i></h3>
<br>
<h2 class="title">Test the controller behavior</h2>
<section class="sub_section">
    <h3>How does it works ?</h3>
    <h4>● Controller Resolution</h4>
    <p>As you can see, the first URL segment <i>(e.g., <code class="color-string">/template</code> for this page)</i> is used to determine which controller to use for the page, in this case, <code class="color-object"><i>Template</i>Controller</code></p>
    <h4>● Method invocation</h4>
    <p>The second segment of the URL, if it exists, is used as the method to invoke.</p>
    <p>For example, <code class="color-string">/template/test</code> will call the <code class="color-function">test()</code> method of the <code class="color-object">TemplateController</code> <i>(if it exists).</i></p>
    <p>Any remaining URL segments <i>(if any exists)</i> will be passed as arguments to the invoked method.</p>
    <br>
    <h3>Exemple :</h3>
    <ol>
        <li><a href="/template/testFunction"><b>/template/testFunction</b></a> <i>(Will call 'testFunction' without any arguments)</i></li>
        <li><a href="/template/testFunction/arg1"><b>/template/testFunction/arg1</b></a> <i>(Will call 'testFunction' with one argument)</i></li>
        <li><a href="/template/testFunction/arg1/arg2"><b>/template/testFunction/arg1/arg2</b></a> <i>(Will call 'testFunction' with multiple arguments)</i></li>
    </ol>
    <p>💡 Feel free to also edit the url directly !</p>
    <br>
    <section>
        <h3>Returned data :</h3>
        <pre><code class="color-string"><?= $test_data ?></code></pre>
    </section>    
</section>
<br>
<br>
<h2 class="title">Model Template</h2>
<section class="sub_section">
    <h3>What is a Model?</h3>
    <p>A model (also named 'Entity') represent an object, in most cases stored in a Database.</p>
    <p>For this exemple project, we will store a list of all created <code class="color-object">TemplateModel</code> instances in our current session <i>(Accessible with <code class="color-variable">$_SESSION<b class="color-snippet">[</b><b class="color-string">'Models'</b><b class="color-snippet">]</b></code>)</i></p>
    <p>You can create new <code class="color-object">TemplateModel</code> from the <code class="color-function">form</code> section below.</p>
    <br>
    <h3>Models list :</h3>
    <?php
        if(count($models) == 0) {
            echo("<code><b class='color-string'>No models stored in the current session</b></code>");
        } else {
            foreach($models as $model) {
                echo("<code><b class='color-type'>object</b><b class='color-snippet'>(</b><b class='color-object'>TemplateModel</b><b class='color-snippet'>)</b> <b class='color-function'>getName()<b><b class='color-type'>:string</b></b></b>-><b class='color-string'>\"" . $model->getName() . "\"</b> <b class='color-function'>getBirthDate()<b class='color-type'>:string</b></b>-><b class='color-string'>\"" . $model->getBirthDate() . "\"</b> <b class='color-function'>getIsMale()<b class='color-type'>:bool</b></b>-><b class='color-string'>\"" . $model->getIsMale() . "\"</b> <b class='color-function'>getAge()<b class='color-type'>:int</b></b>-><b class='color-string'>\"" . $model->getAge() . "\"</b></code><br>");
            }                
        }
    ?>
</section>
<br>
<br>
<h2 class="title">Forms</h2>
<section class="sub_section">
    <p>These forms will create new <code class="color-object">TemplateModel</code> instances and store them in the <code class="color-variable">$_SESSION<b class="color-snippet">[</b><b class="color-string">'Models'</b><b class="color-snippet">]</b></code> variable as mentionned before.</p>
    <p>💡 You can check the current <code class="color-object">TemplateModel</code> instances list in the <code>Model Template</code> section.</p>
    <br>
    <h3>POST form</h3>
    <form method="POST" action="#">
        <label for="name">Name</label>
        <input name="name" type="text" placeholder="Name" required>

        <label for="born">Born date</label>
        <input name="born" type="date" required>

        <label for="gender">Gender</label>
        <select name="gender">
            <option value="true">Male</option>
            <option value="false">Female</option>
        </select>

        <!-- CSRF Token -->
        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?? '' ?>">

        <input type="submit" value="Create">
    </form>
    <br>
    <h3>POST form <i class="color-warning">(Without CSRF Token)</i></h3>
    <form method="POST" action="#">
        <label for="name">Name</label>
        <input name="name" type="text" placeholder="Name" required>

        <label for="born">Born date</label>
        <input name="born" type="date" required>

        <label for="gender">Gender</label>
        <select name="gender">
            <option value="true">Male</option>
            <option value="false">Female</option>
        </select>

        <input type="submit" value="Create">
    </form>

    <br>
    <a href="template/clearModels">Clear all session's models</a>
</section>
<br>
<br>
<h2 class="title">API</h2>
<section class="sub_section">
    <script src="/scripts/api.js"></script>
    <br>
    <button onclick="getExempleData()">Fetch API/exempleData</button>
    <section id="fetch_ex_result" class="vertical"></section>
    <br>
    <p>This data is randomly generated by our API</p>
    <button onclick="getExempleModelTemplate()">Fetch API/exempleModelTemplate</button>
    <section id="fetch_ex2_result" class="vertical"></section>
</section>
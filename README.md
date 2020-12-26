OpenServer:

<p>HTTP: Apache-PHP-7</p>
<p>PHP-7.1</p>
<p>MySQL-5.6</p>
<hr>

<p>create migrate<br>
    php yii migrate/create <name migrate></p>
    

<p>create tables in db<br>
    php yii migrate</p>
<hr>

<div class="highlight highlight-text-html-php"><pre><span class="pl-k">return</span> [
    <span class="pl-s">'class'</span> =&gt; <span class="pl-s">'yii\db\Connection'</span>,
    <span class="pl-s">'dsn'</span> =&gt; <span class="pl-s">'mysql:host=localhost;dbname=site'</span>,
    <span class="pl-s">'username'</span> =&gt; <span class="pl-s">'root'</span>,
    <span class="pl-s">'password'</span> =&gt; <span class="pl-s">'root'</span>,
    <span class="pl-s">'charset'</span> =&gt; <span class="pl-s">'utf8'</span>,
];</pre></div>



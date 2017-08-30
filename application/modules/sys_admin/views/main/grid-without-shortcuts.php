<?php $ci = &get_instance();

?>

<div class="col s12">
    <div>
        <div class="section scrollspy">
            <p class="caption">We are using a standard 12 column fluid responsive grid system. The grid helps you layout your page in an ordered, easy fashion.</p>
            <h3 class="header">H3 Container</h3>
            <p>The container class is not strictly part of the grid but is important in laying out content. It allows you to center your page content. The <code class=" language-markup">container</code> class is set to ~70% of the window width. It helps you center and contain your page content. We use the container to contain our body content.

            </p><h4>H4 Demo</h4>
            <p>Try the button below to see what the page looks like without containers</p>
            <a id="container-toggle-button" class="btn waves-effect waves-light">Turn off Containers</a>

            <!-- Container Visual Demo -->
            <div class="row">
                <div class="col s12">
                    <div class="browser-window">
                        <div class="top-bar">
                            <div class="circles">
                                <div id="close-circle" class="circle"></div>
                                <div id="minimize-circle" class="circle"></div>
                                <div id="maximize-circle" class="circle"></div>
                            </div>
                        </div>
                        <div class="content">
                            <div class="row">

                                <div id="site-layout-example-top" class="col s12">
                                    <!-- <p class="flat-text-logo"></p> -->
                                </div>
                                <div id="site-layout-example-right" class="col s12">
                                    <div class="container">

                                        <p class="flat-text small"></p>
                                        <p class="flat-text full-width"></p>
                                        <p class="flat-text full-width"></p>
                                        <p class="flat-text full-width"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <p>To add a container just put your content inside a <code class=" language-markup"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span><span class="token punctuation">&gt;</span></span></code> tag with a <code class=" language-markup">container</code> class. Here's an example of how your page might be set up.</p>

          <pre class=" language-markup"><code class=" language-markup">
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>body</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>container<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
                  <span class="token comment" spellcheck="true">&lt;!-- Page Content goes here --&gt;</span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>body</span><span class="token punctuation">&gt;</span></span>
              </code></pre>

        </div>
		
        <!-- Grid visual demo -->
        <div class="scrollspy">
            <h3 class="header">H3 Introduction</h3>
            <p>Take a look at this section to quickly understand how the grid works!</p>
            <h4>H4 12 Columns</h4>
            <p>Our standard grid has 12 columns. No matter the size of the browser, each of these columns will always have an equal width.</p>
            <div class="row">
                <div class="col s1 grid-example"><span class="flow-text">1</span></div>

                <div class="col s1 grid-example"><span class="flow-text">2</span></div>
                <div class="col s1 grid-example"><span class="flow-text">3</span></div>
                <div class="col s1 grid-example"><span class="flow-text">4</span></div>
                <div class="col s1 grid-example"><span class="flow-text">5</span></div>
                <div class="col s1 grid-example"><span class="flow-text">6</span></div>
                <div class="col s1 grid-example"><span class="flow-text">7</span></div>
                <div class="col s1 grid-example"><span class="flow-text">8</span></div>
                <div class="col s1 grid-example"><span class="flow-text">9</span></div>
                <div class="col s1 grid-example"><span class="flow-text">10</span></div>
                <div class="col s1 grid-example"><span class="flow-text">11</span></div>
                <div class="col s1 grid-example"><span class="flow-text">12</span></div>
            </div>
            <p>To get a feel of how the grid is used in HTML, take a look at the code below which will produce a similar result to the one above.</p>
          <pre class=" language-markup"><code class=" language-markup">
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>row<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s1<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>1<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s1<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>2<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s1<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>3<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s1<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>4<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s1<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>5<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s1<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>6<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s1<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>7<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s1<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>8<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s1<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>9<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s1<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>10<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s1<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>11<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s1<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>12<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
              </code></pre>
            <p>Note: For now, just know that the <code class=" language-markup">s1</code> stands for small-1 which in plain English means "1 column on small screens".</p>

            <br>

            <h4>H4 Columns live inside Rows</h4>
            <p>Remember when you are creating your layout that all columns must be contained inside a row and that you must add the <code class=" language-markup">col</code> class to your inner divs to make them into columns</p>
            <div class="row">
                <div class="col s12 grid-example"><span class="flow-text">This div is 12-columns wide on all screen sizes</span></div>
                <div class="col s6 grid-example"><span class="flow-text">6-columns (one-half)</span></div>
                <div class="col s6 grid-example"><span class="flow-text">6-columns (one-half)</span></div>
            </div>
          <pre class=" language-markup"><code class=" language-markup">
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>row<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s12<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>This div is 12-columns wide<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s6<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>This div is 6-columns wide<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s6<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>This div is 6-columns wide<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
              </code></pre>

            <br>
        </div>

        <!-- Grid Offsets -->
        <div class="section scrollspy">
            <h2 class="header">H2 Offsets</h2>
            <p>To offset, simply add <code class=" language-markup">offset-s2</code> to the class where <code class=" language-markup">s</code> signifies the screen class-prefix (s = small, m = medium, l = large) and the number after is the number of columns you want to offset by.</p>
            <div class="row">
                <div class="col s12 grid-example"><span class="flow-text">This div is 12-columns wide on all screen sizes</span></div>
                <div class="col s6 offset-s6 grid-example"><span class="flow-text">6-columns (offset-by-6)</span></div>
            </div>
          <pre class=" language-markup"><code class=" language-markup">
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>row<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s12<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>span</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>flow-text<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>This div is 12-columns wide on all screen sizes<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>span</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s6 offset-s6<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>span</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>flow-text<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>6-columns (offset-by-6)<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>span</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
              </code></pre>
        </div>

        <br>

        <!-- Grid push and pull -->
        <div class="section scrollspy">
            <h2 class="header">H2 Push and Pull</h2>
            <p>You can easily change the order of your columns with push and pull. Simply add <code class=" language-markup">push-s2</code> or <code class=" language-markup">pull-s2</code> to the class where <code class=" language-markup">s</code> signifies the screen class-prefix (s = small, m = medium, l = large) and the number after is the number of columns you want to push or pull by.</p>
            <div class="row">
                <div class="col s7 push-s5 grid-example"><span style="font-size: 14px;">This div is 7-columns wide on pushed to the right by 5-columns.</span></div>
                <div class="col s5 pull-s7 grid-example"><span style="font-size: 14px;">5-columns wide pulled to the left by 7-columns.</span></div>
            </div>
          <pre class=" language-markup"><code class=" language-markup">
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>row<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s7 push-s5<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>span</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>flow-text<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>This div is 7-columns wide on pushed to the right by 5-columns.<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>span</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s5 pull-s7<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>span</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>flow-text<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>5-columns wide pulled to the left by 7-columns.<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>span</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
              </code></pre>
        </div>

        <br>

        <!-- Creating Layouts -->
        <div class="scrollspy">
            <h3 class="header">H3 Creating Layouts</h3>
            <p>Here we will show you how to create some commonly used layouts with our grid system. Hopefully these will get you more comfortable with laying out elements. To keep these demos simple, the ones here will not be responsive.</p>
            <div class="row">
                <div class="col s12 m6">
                    <h4>H4 Section</h4>
                    <p>The section class is used for simple top and bottom padding. Just add the <code class=" language-markup">section</code> class to your div's containing large blocks of content.</p>
                </div>
                <div class="col s12 m6">
                    <h4>H4 Divider</h4>
                    <p>Dividers are 1 pixel lines that help break up your content. Just add the <code class=" language-markup">divider</code> to a div in between your content.</p>
                </div>
            </div>

            <h4>H4 Example Sections and Dividers</h4>
            <div class="divider"></div>
            <div class="section">
                <h5>H5 Section 1</h5>
                <p>Stuff</p>
            </div>
            <div class="divider"></div>
            <div class="section">
                <h5>H5 Section 2</h5>
                <p>Stuff</p>
            </div>
            <div class="divider"></div>
            <div class="section">
                <h5>H5 Section 3</h5>
                <p>Stuff</p>
            </div>
            <div class="divider"></div>
          <pre class=" language-markup"><code class=" language-markup">
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>divider<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>section<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>h5</span><span class="token punctuation">&gt;</span></span>Section 1<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>h5</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>p</span><span class="token punctuation">&gt;</span></span>Stuff<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>p</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>divider<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>section<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>h5</span><span class="token punctuation">&gt;</span></span>Section 2<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>h5</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>p</span><span class="token punctuation">&gt;</span></span>Stuff<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>p</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>divider<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>section<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>h5</span><span class="token punctuation">&gt;</span></span>Section 3<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>h5</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>p</span><span class="token punctuation">&gt;</span></span>Stuff<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>p</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
              </code>
          </pre>
            <br>

            <h4>H4 Example Promotion Table</h4>
            <p>If we want 3 divs that are equal size, we define the divs with a width of 4-columns, 4+4+4 = 12, which nicely adds up to 12. Inside those divs, we can put our content. Take our front page content for example. We've modified it slightly for the sake of this example.</p>
            <div class="row">
                <div class="col s4">
                    <div class="center promo promo-example">
                        <i class="material-icons">flash_on</i>
                        <p class="promo-caption">Speeds up development</p>
                        <p class="light center">We did most of the heavy lifting for you to provide a default stylings that incorporate our custom components.</p>
                    </div>
                </div>
                <div class="col s4">
                    <div class="center promo promo-example">
                        <i class="material-icons">group</i>
                        <p class="promo-caption">User Experience Focused</p>
                        <p class="light center">By utilizing elements and principles of Material Design, we were able to create a framework that focuses on User Experience.</p>
                    </div>
                </div>
                <div class="col s4">
                    <div class="center promo promo-example">
                        <i class="material-icons">settings</i>
                        <p class="promo-caption">Easy to work with</p>
                        <p class="light center">We have provided detailed documentation as well as specific code examples to help new users get started.</p>
                    </div>
                </div>
            </div>

          <pre class=" language-markup"><code class=" language-markup">
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>row<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>

                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s4<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
                  <span class="token comment" spellcheck="true">&lt;!-- Promo Content 1 goes here --&gt;</span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s4<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
                  <span class="token comment" spellcheck="true">&lt;!-- Promo Content 2 goes here --&gt;</span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s4<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
                  <span class="token comment" spellcheck="true">&lt;!-- Promo Content 3 goes here --&gt;</span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>

                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
              </code></pre>

            <br>

            <h4>H4 Example Side Navigation Layout</h4>
            <p>You can see how easy it is to create layouts using the grid system. Just remember to make sure your column numbers add up to 12 for an even layout.</p>

            <div class="row">
                <div class="col s12">
                    <div class="browser-window">
                        <div class="top-bar">
                            <div class="circles">
                                <div id="close-circle" class="circle"></div>
                                <div id="minimize-circle" class="circle"></div>
                                <div id="maximize-circle" class="circle"></div>
                            </div>
                        </div>
                        <div class="content">
                            <div class="row">

                                <div id="site-layout-example-top" class="col s12">
                                    <!-- <p class="flat-text-logo"></p> -->
                                </div>
                                <div id="site-layout-example-left" class="col s3">
                                    <p class="flat-text-header"></p>
                                    <p class="flat-text"></p>
                                    <p class="flat-text"></p>
                                </div>
                                <div id="site-layout-example-right" class="col s9">
                                    <p class="flat-text"></p>
                                    <p class="flat-text"></p>
                                    <p class="flat-text"></p>
                                    <p class="flat-text"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

          <pre class=" language-markup"><code class=" language-markup">
                  <span class="token comment" spellcheck="true">&lt;!-- Navbar goes here --&gt;</span>

                  <span class="token comment" spellcheck="true">&lt;!-- Page Layout here --&gt;</span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>row<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>

                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s3<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
                  <span class="token comment" spellcheck="true">&lt;!-- Grey navigation panel --&gt;</span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>

                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s9<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
                  <span class="token comment" spellcheck="true">&lt;!-- Teal page content  --&gt;</span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>

                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
              </code></pre>
        </div>


        <!-- Creating Responsive Layouts -->
        <div class="scrollspy">
            <h3 class="header">H3 Creating Responsive Layouts</h3>
            <p>Above we showed you how to layout elements using our grid system. Now we'll show you how to design your layouts so that they look great on all screen sizes.</p>
            <h4>H4 Screen Sizes</h4>
            <table class="highlight">
                <thead>
                <tr>
                    <th></th>
                    <th data-field="id">Mobile Devices <br>&lt;= 600px</th>
                    <th data-field="name">Tablet Devices <br>&lt;= 992px</th>
                    <th data-field="price">Desktop Devices <br>&gt; 992px</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><strong>Class Prefix</strong></td>
                    <td><code class=" language-markup">.s</code></td>
                    <td><code class=" language-markup">.m</code></td>
                    <td><code class=" language-markup">.l</code></td>
                </tr>
                <tr>
                    <td><strong>Container Width</strong></td>
                    <td>85%</td>
                    <td>85%</td>
                    <td>70%</td>
                </tr>
                <tr>
                    <td><strong>Number of Columns</strong></td>
                    <td>12</td>
                    <td>12</td>
                    <td>12</td>
                </tr>
                </tbody>
            </table>

            <br>

            <h4>H4 Adding Responsiveness</h4>
            <p>In the previous examples, we only defined the size for small screens using <code class=" language-markup">"col s12"</code>. This is fine if we want a fixed layout since the rules propagate upwards. By just saying s12, we are essentially saying <code class=" language-markup">"col s12 m12 l12"</code>. But by explicitly defining the size we can make our website more responsive.</p>

            <div class="row">
                <div class="grid-example col s12 teal lighten-2"><span class="flow-text">I am always full-width (col s12)</span></div>
                <div class="grid-example col s12 m6 teal lighten-2"><span class="flow-text">I am full-width on mobile (col s12 m6)</span></div>
            </div>
          <pre class=" language-markup"><code class=" language-markup">
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>row<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>grid-example col s12<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>span</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>flow-text<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>I am always full-width (col s12)<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>span</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>grid-example col s12 m6<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>span</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>flow-text<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>I am full-width on mobile (col s12 m6)<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>span</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
              </code></pre>

            <br>

            <h4>H4 Responsive Side Navigation Layout</h4>
            <p>In this example below, we take the same layout from above, but we make it responsive by defining how many columns the div should take up on each screen size. Try resizing your browser and watch the layout change below.</p>

            <div class="row">
                <div class="col s12">
                    <div class="browser-window">
                        <div class="top-bar">
                            <div class="circles">
                                <div id="close-circle" class="circle"></div>
                                <div id="minimize-circle" class="circle"></div>
                                <div id="maximize-circle" class="circle"></div>
                            </div>
                        </div>
                        <div class="content">
                            <div class="row">

                                <div id="site-layout-example-top" class="col s12">
                                    <!-- <p class="flat-text-logo"></p> -->
                                </div>
                                <div id="site-layout-example-left" class="col s12 m4 l3">
                                    <p class="flat-text-header"></p>
                                    <p class="flat-text"></p>
                                    <p class="flat-text"></p>
                                </div>
                                <div id="site-layout-example-right" class="col s12 m8 l9">
                                    <p class="flat-text"></p>
                                    <p class="flat-text"></p>
                                    <p class="flat-text"></p>
                                    <p class="flat-text"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

          <pre class=" language-markup"><code class=" language-markup">
                  <span class="token comment" spellcheck="true">&lt;!-- Navbar goes here --&gt;</span>

                  <span class="token comment" spellcheck="true">&lt;!-- Page Layout here --&gt;</span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>row<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>

                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s12 m4 l3<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span> <span class="token comment" spellcheck="true">&lt;!-- Note that "m4 l3" was added --&gt;</span>
        <span class="token comment" spellcheck="true">&lt;!-- Grey navigation panel

              This content will be:
          3-columns-wide on large screens,
          4-columns-wide on medium screens,
          12-columns-wide on small screens  --&gt;</span>

                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>

                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s12 m8 l9<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span> <span class="token comment" spellcheck="true">&lt;!-- Note that "m8 l9" was added --&gt;</span>
        <span class="token comment" spellcheck="true">&lt;!-- Teal page content

              This content will be:
          9-columns-wide on large screens,
          8-columns-wide on medium screens,
          12-columns-wide on small screens  --&gt;</span>

                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>

                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
              </code></pre>

            <h4>H4 More Responsive Grid Examples</h4>
            <div class="row">
                <div class="col grid-example s12 blue lighten-1"><span class="flow-text">s12</span></div>
                <div class="col grid-example s12 m4 l2 teal lighten-1"><span class="flow-text">s12 m4 l2</span></div>
                <div class="col grid-example s12 m4 l8 teal lighten-1"><span class="flow-text">s12 m4 l8</span></div>
                <div class="col grid-example s12 m4 l2 teal lighten-1"><span class="flow-text">s12 m4 l2</span></div>
                <div class="col grid-example s12 m6 l3 purple lighten-3"><span class="flow-text">s12 m6 l3</span></div>
                <div class="col grid-example s12 m6 l3 purple lighten-3"><span class="flow-text">s12 m6 l3</span></div>
                <div class="col grid-example s12 m6 l3 purple lighten-3"><span class="flow-text">s12 m6 l3</span></div>
                <div class="col grid-example s12 m6 l3 purple lighten-3"><span class="flow-text">s12 m6 l3</span></div>
            </div>
            <div class="row">
            <pre class=" language-markup"><code class=" col s12 language-markup">
                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>row<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s12<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>p</span><span class="token punctuation">&gt;</span></span>s12<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>p</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s12 m4 l2<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>p</span><span class="token punctuation">&gt;</span></span>s12 m4<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>p</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s12 m4 l8<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>p</span><span class="token punctuation">&gt;</span></span>s12 m4<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>p</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s12 m4 l2<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>p</span><span class="token punctuation">&gt;</span></span>s12 m4<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>p</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>row<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s12 m6 l3<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>p</span><span class="token punctuation">&gt;</span></span>s12 m6 l3<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>p</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s12 m6 l3<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>p</span><span class="token punctuation">&gt;</span></span>s12 m6 l3<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>p</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s12 m6 l3<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>p</span><span class="token punctuation">&gt;</span></span>s12 m6 l3<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>p</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col s12 m6 l3<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>p</span><span class="token punctuation">&gt;</span></span>s12 m6 l3<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>p</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
                </code></pre>
            </div>
        </div>

    </div>


</div>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-56218128-1', 'auto');
    ga('require', 'displayfeatures');
    ga('send', 'pageview');
</script>
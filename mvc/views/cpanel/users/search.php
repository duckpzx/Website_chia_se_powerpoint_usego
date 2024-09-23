<main>
    <div class="container">
    <div class="block"></div>
        <div class="group-wrapper">
            <div class="group-title">
                <input type="search" 
                placeholder="Tìm kiếm..." 
                name="search-keyword" 
                required=""
                value="<?php if(!empty( $_GET['q'] )) echo $_GET['q']; ?>">
            </div>
        </div>
        <div class="group-wrapper group-filter">
            <div class="group-title">
                <div class="group-selector">
                    <section>
                        <button class="powerpoint filter">Powerpoint</button>
                    </section>
                </div>
            </div>
        </div>
        <div class="container-body">
            <div class="lists-body" 
                data-temp="<?= _TEMPLATE ?>"
                data-template="<?= _TEMPLATE . 'images/uploads/powerpoint-images/' ?>">
            </div>
        </div>
    </div>
</main>
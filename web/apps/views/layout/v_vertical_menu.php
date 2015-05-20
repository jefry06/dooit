<!-- START X-NAVIGATION VERTICAL -->
<ul class="x-navigation x-navigation-horizontal x-navigation-panel">
    <!-- TOGGLE NAVIGATION -->
    <li class="xn-icon-button">
        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
    </li>
    <!-- END TOGGLE NAVIGATION -->

    <li>
        <a href="<?=base_url()?>"><span class="fa fa-home"></span> </a>
    </li>

    <!-- SEARCH -->
    <li class="xn-search">
        <form role="form" action="<?=base_url('product/search')?>" method="post">
            <input type="text" name="keyword" placeholder="Search..."/>
        </form>
    </li>
    <!-- END SEARCH -->
</ul>
<!-- END X-NAVIGATION VERTICAL -->

<div class="copyright">
    &copy; <?=date('Y')?> GAPS - PT Mobile Coin Asia | <a href="<?=base_url('term_and_condition')?>">Syarat dan Ketentuan</a> | <a href="<?=base_url('privacy')?>">Privasi</a>
</div>
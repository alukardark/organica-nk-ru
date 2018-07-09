<?if(!is_front_page()){?>
    </div>
<?}?>
<footer>
    <ul class="footer-list">
        <li class="address">
            <div><?=get_field('address-footer-contact', 72)?></div>
            <div>© <?php echo date("Y"); ?> АО «Органика»</div>
        </li>
        <li class="reception">
            <div><?=get_field('address-footer-title-1', 72)?>: <a href="tel:<?=get_field('address-footer-phone-1', 72)?>"> <?=get_field('address-footer-phone-1', 72)?></a></div>
            <a class="email" href="mailto:<?=get_field('address-footer-email-1', 72)?>"><?=get_field('address-footer-email-1', 72)?></a>
        </li>
        <li class="sales-department">
            <div><?=get_field('address-footer-title-2', 72)?>: <a href="tel:<?=get_field('address-footer-phone-2', 72)?>"><?=get_field('address-footer-phone-2', 72)?></a></div>
            <a class="email" href="mailto:<?=get_field('address-footer-email-2', 72)?>"><?=get_field('address-footer-email-2', 72)?></a>
        </li>
        <li class="copyriht">
            <a target="_blank" href="/copyright/">Информация для правообладателей</a>
            <br>
            <a target="_blank" href="/privacy/">Политика конфиденциальности</a>
        </li>
        <li class="feedback">
            <a href="/contact/">Обратная связь</a>
        </li>
        <li class="logo-axi">
            <a rel="nofollow" title="Создание, продвижение и администрирование сайтов" target="_blank" href="https://www.web-axioma.ru">
                <img src="<?=get_template_directory_uri();?>/img/logo-axi.png" alt="Логотип-AXI">
            </a>
        </li>
        <li class="hid-address">
            © <?php echo date("Y"); ?> АО «Органика»
        </li>
    </ul>
</footer>
<?if(!is_front_page()){?>
    </div>
<?}?>
	



<div class="modal fade" id="articles-enter" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="content-modal">
            <div class="sort-list-wrap-close" type="button" data-dismiss="modal" aria-label="Close"></div>
            <div class="cont">
                <div class="articles-enter-wrap">
                    <h3>Вход для специалистов здравоохранения</h3>
                    <p>Вся информация, размещенная в данном разделе веб-сайта, предназначена исключительно для специалистов здравоохранения — медицинских 
        и фармацевтических работников. Если Вы не являетесь специалистом здравоохранения, в соответствии с положениями действующего законодательства РФ, Вы не имеете права доступа к информации, 
        размещенной в данном разделе веб-сайта.</p>
                    <div class="articles-enter-links">
                        <button class="articles-enter-yes"><a href="/">Да, я специалист</a></button>
                        <a href="/" class="articles-enter-no">Нет, я не специалист</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div id="scroll-top"></div>

<?php wp_footer(); ?>

</body>
</html>

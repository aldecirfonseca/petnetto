<?= $this->extend("layout\layoutHome") ?>

<?= $this->section("conteudo") ?>

<style>
    .service-icon-img {
    width: 90px !important;
    height: 90px !important;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #fff;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
</style>

    <div class="hero-wrap js-fullheight"
        style="background-image: url('<?= base_url("assets/images/bg_1.jpg") ?>');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div
                class="row no-gutters slider-text js-fullheight align-items-center justify-content-center"
                data-scrollax-parent="true">
                <div class="col-md-11 ftco-animate text-center">
                    <h1 class="mb-4">Cuidados de altíssima qualidade para animais de estimação que você vai adorar </h1>
                    <p><a href="#" class="btn btn-primary mr-md-4 py-3 px-4">Saiba mais... <span
                                class="ion-ios-arrow-forward"></span></a></p>
                </div>
            </div>
        </div>
    </div>

<section class="ftco-section bg-light ftco-no-pt ftco-intro">
    <div class="container">
        <div class="row">
            <?php foreach ($servicosAtivos as $servico): ?>
            <div class="col-md-4 d-flex align-self-stretch px-4 ftco-animate">
                <div class="d-block services text-center">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <?php if ($servico['img']): ?>
                            <img src="<?= base_url($servico['img']) ?>" 
                                 alt="<?= esc($servico['nome']) ?>" 
                                 class="service-icon-img" 
                                 style="width:60px;height:60px;border-radius:50%;object-fit:cover;">
                        <?php else: ?>
                            <span class="flaticon-pawprint"></span>
                        <?php endif; ?>
                    </div>
                    <div class="media-body p-4">
                        <h3 class="heading"><?= esc($servico['nome']) ?></h3>
                        <p><?= esc(substr($servico['descricao'], 0, 254)) ?></p>
                        <a href="#" 
                           class="btn-custom d-flex align-items-center justify-content-center">
                            <span class="fa fa-chevron-right"></span>
                            <i class="sr-only">Saiba mais...</i>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            
            <?php if (empty($servicosAtivos)): ?>
            <div class="col-12 text-center py-5">
                <h4>Nenhum serviço ativo disponível no momento.</h4>
                <p>Volte em breve para conhecer nossos serviços!</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>


    <section class="ftco-section testimony-section"
        style="background-image: url('<?= base_url("assets/images/bg_2.jpg") ?>);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row justify-content-center pb-5 mb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <h2>Feedbacks de nossos clientes</h2>
                </div>
            </div>
            <div class="row ftco-animate">
                <div class="col-md-12">
                    <div class="carousel-testimony owl-carousel ftco-owl">
                        <div class="item">
                            <div class="testimony-wrap py-4">
                                <div
                                    class="icon d-flex align-items-center justify-content-center"><span
                                        class="fa fa-quote-left"></span></div>
                                <div class="text">
                                    <p class="mb-4">
                                        A Pet Netto é simplesmente maravilhosa! Meu cachorro sempre volta dos passeios feliz e bem cuidado. O atendimento é excelente e os profissionais são muito atenciosos. Recomendo de olhos fechados!
                                    </p>
                                    <div class="d-flex align-items-center">
                                        <div class="pl-3">
                                            <p class="name">— Carlos Henrique, Designer Gráfico</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap py-4">
                                <div
                                    class="icon d-flex align-items-center justify-content-center"><span
                                        class="fa fa-quote-left"></span></div>
                                <div class="text">
                                    <p class="mb-4">
                                        Levo meu gato para o spa da Pet Netto todo mês e é incrível como ele fica mais tranquilo e saudável. O ambiente é limpo, seguro e cheio de carinho. É bom saber que temos um serviço tão completo aqui em Muriaé!
                                    </p>
                                    <div class="d-flex align-items-center">
                                        <div class="pl-3">
                                            <p class="name">— Juliana Mendes, Professora</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap py-4">
                                <div
                                    class="icon d-flex align-items-center justify-content-center"><span
                                        class="fa fa-quote-left"></span></div>
                                <div class="text">
                                    <p class="mb-4">
                                        Desde que comecei a usar o plano mensal da Pet Netto, minha rotina ficou muito mais fácil. Eles cuidam do meu pet com responsabilidade e afeto. É como deixar com alguém da família!
                                    </p>
                                    <div class="d-flex align-items-center">
                                        <div class="pl-3">
                                            <p class="name">— Fernanda Souza, Empresária</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center pb-5 mb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <h2>Galeria</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 ftco-animate">
                    <div class="work mb-4 img d-flex align-items-end"
                        style="background-image: url('<?= base_url("assets/images/gallery-1.jpg") ?>');">
                        <a href="<?= base_url("assets/images/gallery-1.jpg") ?>"
                            class="icon image-popup d-flex justify-content-center align-items-center">
                            <span class="fa fa-expand"></span>
                        </a>
                        <div class="desc w-100 px-4">
                            <div class="text w-100 mb-3">
                                <span>Cat</span>
                                <h2><a href="work-single.html">Persian Cat</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ftco-animate">
                    <div class="work mb-4 img d-flex align-items-end"
                        style="background-image: url('<?= base_url("assets/images/gallery-2.jpg") ?>');">
                        <a href="<?= base_url("assets/images/gallery-2.jpg") ?>"
                            class="icon image-popup d-flex justify-content-center align-items-center">
                            <span class="fa fa-expand"></span>
                        </a>
                        <div class="desc w-100 px-4">
                            <div class="text w-100 mb-3">
                                <span>Dog</span>
                                <h2><a href="work-single.html">Pomeranian</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ftco-animate">
                    <div class="work mb-4 img d-flex align-items-end"
                        style="background-image: url('<?= base_url("assets/images/gallery-3.jpg") ?>');">
                        <a href="<?= base_url("assets/images/gallery-3.jpg") ?>"
                            class="icon image-popup d-flex justify-content-center align-items-center">
                            <span class="fa fa-expand"></span>
                        </a>
                        <div class="desc w-100 px-4">
                            <div class="text w-100 mb-3">
                                <span>Cat</span>
                                <h2><a href="work-single.html">Sphynx Cat</a></h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 ftco-animate">
                    <div class="work mb-4 img d-flex align-items-end"
                        style="background-image: url('<?= base_url("assets/images/gallery-4.jpg") ?>');">
                        <a href="<?= base_url("assets/images/gallery-4.jpg") ?>"
                            class="icon image-popup d-flex justify-content-center align-items-center">
                            <span class="fa fa-expand"></span>
                        </a>
                        <div class="desc w-100 px-4">
                            <div class="text w-100 mb-3">
                                <span>Cat</span>
                                <h2><a href="work-single.html">British Shorthair</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ftco-animate">
                    <div class="work mb-4 img d-flex align-items-end"
                        style="background-image: url('<?= base_url("assets/images/gallery-5.jpg") ?>');">
                        <a href="<?= base_url("assets/images/gallery-5.jpg") ?>"
                            class="icon image-popup d-flex justify-content-center align-items-center">
                            <span class="fa fa-expand"></span>
                        </a>
                        <div class="desc w-100 px-4">
                            <div class="text w-100 mb-3">
                                <span>Dog</span>
                                <h2><a href="work-single.html">Beagle</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ftco-animate">
                    <div class="work mb-4 img d-flex align-items-end"
                        style="background-image: url('<?= base_url("assets/images/gallery-6.jpg") ?>');">
                        <a href="<?= base_url("assets/images/gallery-6.jpg") ?>"
                            class="icon image-popup d-flex justify-content-center align-items-center">
                            <span class="fa fa-expand"></span>
                        </a>
                        <div class="desc w-100 px-4">
                            <div class="text w-100 mb-3">
                                <span>Dog</span>
                                <h2><a href="work-single.html">Pug</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>
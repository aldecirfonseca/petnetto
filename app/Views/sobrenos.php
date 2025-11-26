<?= $this->extend("layout\layoutHome") ?>

<?= $this->section("conteudo") ?>

    <section class="hero-wrap hero-wrap-2" style="background-image: url('<?= esc($data['image_slogan'] ?? base_url("assets/images/bg_2.jpg")) ?>');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end">
                <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs mb-2"><span class="mr-2"><a href="<?= base_url() ?>">Home <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span><?= esc($data['title'] ?? 'Sobre nós') ?> <i
                                class="ion-ios-arrow-forward"></i></span></p>
                    <h1 class="mb-0 bread"><?= esc($data['title'] ?? 'Sobre nós') ?></h1>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-no-pt ftco-no-pb">
        <div class="container"> 
            <div class="row d-flex no-gutters">
                <div class="col-md-5 d-flex">
                    <div class="img img-video d-flex align-self-stretch align-items-center justify-content-center justify-content-md-center mb-4 mb-sm-0"
                        style="background-image:url('<?= esc($data['image_page'] ?? base_url("assets/images/about-1.jpg")) ?>');">
                    </div>
                </div>
                <div class="col-md-7 pl-md-5 py-md-5">
                    <div class="heading-section pt-md-5">
                        <h2 class="mb-4"><?= esc($data['title'] ?? 'Sobre nós') ?></h2>
                        <?php if (!empty($data['short_description'])): ?>
                            <h4><?= esc($data['short_description']) ?></h4>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <div class="col-md-12 w-100 d-flex">
                            <div class="text pl-3">
                                <?php if (!empty($data['long_description'])): ?>
                                    <p><?= esc($data['long_description']) ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if (!empty($data['valores_empresa'])): ?>
    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center pb-5 mb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <h2>Nossos Valores</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <p style="white-space: pre-line;"><?= esc($data['valores_empresa']) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

<?= $this->endSection() ?>
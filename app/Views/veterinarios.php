<?= $this->extend("layout/layoutHome") ?>

<?= $this->section("conteudo") ?>

<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_2.jpg');"
    data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end">
            <div class="col-md-9 ftco-animate pb-5">
                <p class="breadcrumbs mb-2">
                    <span class="mr-2"><a href="<?= base_url('/') ?>">Home <i class="ion-ios-arrow-forward"></i></a></span>
                    <span>Veterinários <i class="ion-ios-arrow-forward"></i></span>
                </p>
                <h1 class="mb-0 bread">Conheça nossos médicos veterinários</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row">
            <?php if (!empty($data)): ?>
                <?php foreach ($data as $vet): ?>
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="staff">
                            <div class="img-wrap d-flex align-items-stretch">
                                <div class="img align-self-stretch"
                                    style="background-image: url('<?= base_url('uploads/veterinarios/' . $vet['foto']) ?>');">
                                </div>
                            </div>
                            <div class="text pt-3 px-3 pb-4 text-center">
                                <h3><?= esc($vet['nome']) ?></h3>
                                <span class="position mb-2"><?= esc($vet['especialidade']) ?></span>
                                <div class="faded">
                                    <p><?= esc($vet['biografia']) ?></p>
                                    <ul class="ftco-social text-center">
                                        <li class="ftco-animate">
                                            <a href="<?= esc($vet['twitter']) ?>" class="d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
                                        </li>
                                        <li class="ftco-animate">
                                            <a href="<?= $vet['facebook'] ?>" class="d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
                                        </li>
                                        <li class="ftco-animate">
                                            <a href="<?= esc($vet['instagram']) ?>" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"></span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center w-100">Nenhum veterinário cadastrado.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

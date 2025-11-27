<?= $this->extend("layout\layoutHome") ?>

<?= $this->section("conteudo") ?>
    <section class="hero-wrap hero-wrap-2" style="background-image: url(<?= base_url('assets/images/bg_2.jpg') ?>);"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end">
                <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span>Serviços <i
                                class="ion-ios-arrow-forward"></i></span></p>
                    <h1 class="mb-0 bread">Serviços</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-no-pt ftco-no-pb">
        <div class="container">
            <div class="row d-flex no-gutters">
                <div class="col-md-5 d-flex">
                    <div class="img img-video d-flex align-self-stretch align-items-center justify-content-center justify-content-md-center mb-4 mb-sm-0"
                        style="background-image:url(<?= base_url('assets/images/about-1.jpg') ?>);">
                    </div>
                </div>
                <div class="col-md-7 pl-md-5 py-md-5">
                    <div class="heading-section pt-md-5">
                        <h2 class="mb-4">Por que nós escolher?</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-6 services-2 w-100 d-flex">
                            <div class="icon d-flex align-items-center justify-content-center"><span
                                    class="flaticon-stethoscope"></span></div>
                            <div class="text pl-3">
                                <h4>Cuidados médicos</h4>
                                <p>
                                    Seu pet merece o melhor! Contamos com uma equipe de veterinários altamente
                                    qualificados e equipamentos modernos para garantir diagnósticos precisos e
                                    tratamentos eficazes. Aqui, a saúde do seu animal está em boas mãos.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 services-2 w-100 d-flex">
                            <div class="icon d-flex align-items-center justify-content-center"><span
                                    class="flaticon-customer-service"></span></div>
                            <div class="text pl-3">
                                <h4>Suporte ao cliente</h4>
                                <p>
                                    Estamos sempre prontos para ajudar! Nosso atendimento é rápido, gentil e eficiente,
                                    seja para agendar serviços, tirar dúvidas ou resolver qualquer questão. Fale conosco
                                    e tenha a atenção que você e seu pet merecem.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 services-2 w-100 d-flex">
                            <div class="icon d-flex align-items-center justify-content-center"><span
                                    class="flaticon-emergency-call"></span></div>
                            <div class="text pl-3">
                                <h4>Serviços de emergência</h4>
                                <p>
                                    Emergência não tem hora marcada. Por isso, oferecemos atendimento 24h para situações
                                    críticas, com profissionais preparados para agir com rapidez e competência. Seu pet
                                    seguro, a qualquer momento.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 services-2 w-100 d-flex">
                            <div class="icon d-flex align-items-center justify-content-center"><span
                                    class="flaticon-veterinarian"></span></div>
                            <div class="text pl-3">
                                <h4>Ajuda veterinária</h4>
                                <p>
                                    Cuidar é nossa missão. Oferecemos acompanhamento veterinário completo, com atenção
                                    personalizada e muito carinho. Da consulta ao tratamento, seu pet recebe cuidado e
                                    amor em cada etapa.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row mb-5 pb-5">
                <?php foreach ($servicosAtivos as $servico): ?>
                <div class="col-md-4 d-flex align-self-stretch px-4 ftco-animate">
                    <div class="d-block services text-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <?php if ($servico['img']): ?>
                                <img src="<?= base_url($servico['img']) ?>" 
                                    alt="<?= esc($servico['nome']) ?>" 
                                    style="width:60px;height:60px;border-radius:50%;object-fit:cover;">
                            <?php else: ?>
                                <span class="flaticon-pawprint"></span>
                            <?php endif; ?>
                        </div>
                        <div class="media-body p-4">
                            <h3 class="heading"><?= esc($servico['nome']) ?></h3>
                            <p><?= esc(substr($servico['descricao'] ?? '', 0, 150)) ?>...</p>
                            <a href="#" class="btn-custom d-flex align-items-center justify-content-center">
                                <span class="fa fa-chevron-right"></span>
                                <i class="sr-only">Saiba mais...</i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                
                <?php if (empty($servicosAtivos)): ?>
                <div class="col-12 text-center py-5">
                    <h4>Nenhum serviço disponível no momento.</h4>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php

use Config\Session;

session()->setTempdata('isLoggedIn', true, 3600); // expira em 1 hora
session()->setTempdata('userNivel', 2, 3600);     // 2 = administrador ou nível liberado
?>
<?= $this->endSection() ?>
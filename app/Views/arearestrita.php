<?= $this->extend("layout\layoutHome") ?>

<?= $this->section("conteudo") ?>

<section class="mt-5">
    <div class="container">
        <div class="blog-banner">
            <div class="mt-5 mb-5 text-left">
                <h1 style="color: #384aeb;">Área de Configurações</h1>
            </div>
        </div>
    </div>
</section>

<section class="login_box_area section-margin mt-3 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-3">
                <div class="login_box_img">
                    <div class="hover">
                        <h4>Veterinários</h4>
                        <p>
                            Área destinada as configurações referentes ao controle de veterinários. Aqui é possível criar, alterar ou deletar veterinários.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="col-lg-12 mb-3">
                    <a href="<?= base_url('Veterinarios/form/new') ?>" class="btn btn-primary mr-md-4 py-3 px-4">Cadastrar Novo Veterinário</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
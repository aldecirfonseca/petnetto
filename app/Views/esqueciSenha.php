<?= $this->extend("layout/layoutHome") ?>
<?= $this->section("conteudo") ?>

<section class="container mt-5 mb-5">
    <h2>Recuperação de senha</h2>

    <div class="col-md-12 form-group">
        <?= mensagemSucesso() ?>
        <?= mensagemError() ?>
    </div>

    <form method="POST" action="<?= base_url() ?>Usuario/enviarLink">
        <div class="form-group">
            <label>E-mail cadastrado</label>
            <input type="email" name="email" class="form-control" required value="<?= old('email') ?>">
        </div>

        <button class="btn btn-primary mt-3">Enviar link</button>
    </form>
</section>

<?= $this->endSection() ?>

<?= $this->extend("layout\layout_login") ?>

<?= $this->section("conteudo") ?>

<div class="row g-3 mt-5 mb-4">
    <div class="col-6 offset-3">
        <h2>Login</h2>
    </div>
</div>

<form class="row g-3">
    <div class="col-6 offset-3">
        <label for="login">Email</label>
        <input type="text" class="form-control" id="login" placeholder="email@example.com">
    </div>
    <div class="col-6  offset-3">
        <label for="senha">Senha</label>
        <input type="password" class="form-control" id="senha" placeholder="Password">
    </div>
    <div class="col-6 offset-3 mt-4">
        <a href="/" class="btn btn-outline-secondary btn-sm" title="voltar">Voltar</a>
        <button type="submit" class="btn btn-primary btn-sm">Entrar</button>
    </div>
</form>

<?= $this->endSection() ?>
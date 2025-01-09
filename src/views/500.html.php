<?php

include_once './src/views/components/header.html.php';

?>
<div class="h-screen grid place-items-center">
    <div class="text-center">
        <h1 class="lg:text-7xl font-bold uppercase">
            Oups 😵<br><span class="lg:text-8xl">erreur 500</span>
        </h1>
        <p class="my-4 text-gray-600">
            Une erreur inattendue s'est produite sur le serveur
        </p>
        <?php if (isset($this->params['error'])): ?>
            <p class="mb-6 text-red-600 text-sm">
                <?= htmlspecialchars($this->params['error']) ?>
            </p>
        <?php endif; ?>
        <a href="/home" class="btn text-[#0c274e] hover:text-white hover:bg-[#0c274e] hover:shadow-lg">
            Retour à la page d'accueil
        </a>
    </div>
</div>

<?php

include_once './src/views/components/footer.html.php';
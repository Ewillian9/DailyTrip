// Counter 

// Configuration des compteurs avec leurs valeurs finales
const counters = [
{ id: 'counter-adventures', end: 157, suffix: '' },     // aventures
{ id: 'counter-kilometers', end: 15430, suffix: '' },   // km
{ id: 'counter-comments', end: 892, suffix: '' },       // commentaires
{ id: 'counter-photos', end: 3254, suffix: '' },        // photos
{ id: 'counter-shares', end: 467, suffix: '' },         // partages
{ id: 'counter-lorem', end: 789, suffix: '' }           // lorem ipsum
];

// Fonction pour formatter les nombres avec des séparateurs de milliers
const formatNumber = (num) => {
return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
};

// Fonction d'animation pour un compteur individuel
const animateCounter = (counter) => {
const element = document.getElementById(counter.id);
if (!element) return; // Sécurité si l'élément n'existe pas

const duration = 2000; // Durée de l'animation en ms
const steps = 60; // Nombre d'étapes d'animation
const stepDuration = duration / steps;

let current = 0;
const increment = counter.end / steps;

const updateCounter = () => {
current += increment;
if (current > counter.end) {
current = counter.end;
}
element.textContent = formatNumber(Math.floor(current)) + counter.suffix;

if (current < counter.end) {
setTimeout(updateCounter, stepDuration);
}
};

updateCounter();
};

// Fonction pour démarrer l'animation lorsque les éléments sont visibles
const startAnimationOnScroll = () => {
const observer = new IntersectionObserver((entries) => {
entries.forEach(entry => {
if (entry.isIntersecting) {
// Démarre l'animation pour tous les compteurs
counters.forEach(counter => animateCounter(counter));
// Déconnecte l'observer une fois l'animation démarrée
observer.disconnect();
}
});
}, {
threshold: 0.5 // Déclenche quand 50% de l'élément est visible
});

// Observer le conteneur des compteurs
const counterSection = document.querySelector('.grid');
if (counterSection) {
observer.observe(counterSection);
}
};

// Démarrer la détection au chargement de la page
document.addEventListener('DOMContentLoaded', startAnimationOnScroll);



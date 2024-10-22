function toggleLearnMore(id) {
    const detailsDiv = document.getElementById('details-' + id);
    if (detailsDiv.classList.contains('hidden')) {
        detailsDiv.classList.remove('hidden');
    } else {
        detailsDiv.classList.add('hidden');
    }
}
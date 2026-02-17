document.getElementById('gearSwitch').addEventListener('change', function() {
    const type = this.checked ? 'Automatic' : 'Manual';
    fetchPackages(type);
});

function fetchPackages(type) {
    fetch(`/packages?type=${type}`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('packagesContainer').innerHTML = html;
        })
        .catch(err => console.error(err));
}

// Load default packages on page load
fetchPackages('Manual');

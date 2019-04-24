document.addEventListener('DOMContentLoaded', function() {
    elems = document.querySelectorAll('.autocomplete');
    var options = {
      data:{"Alejandro Gleason": null,
        "Ulises Almaguer": null,
        "Brenda Rivera": null,
        "Carlos García": null,
        "Salvador Espinosa": null},
      limit:5 };
    var instances = M.Autocomplete.init(elems, options);
});

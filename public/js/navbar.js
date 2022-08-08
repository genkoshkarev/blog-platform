$for(".y-dropdown-toggle", (e) => {
  $click(e, (event) => {
    let el = $elNext(event.currentTarget);
    $hideToggle(el);
    $for(".y-dropdown-menu", (e) => {
      if (e != el) e.style.display = "none";
    });

    event.stopPropagation();
  });
});

$click("#nav-toggle", (e) => {
  $classToggle(e.currentTarget, "active");
  $hideToggle(".nav-list");
});

$click("html", (e) => {
  $for(".nav-dropdown", (e) => {
    e.style.display = "none";
  });
});

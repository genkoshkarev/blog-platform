function $id(name) {
  return document.getElementById(name);
}
function $(name) {
  return document.querySelector(name);
}
function $$(name) {
  return document.querySelectorAll(name);
}
function $for(list, func) {
  for (let item of $inEls(list)) {
    func(item);
  }
}

function $style(e, prop, v) {
  $inEl(e).style.setProperty(prop, v);
}
function $classAdd(e, name) {
  $inEl(e).classList.add(name);
}
function $classDel(e, name) {
  $inEl(e).classList.remove(name);
}
function $classToggle(e, name) {
  e.classList.toggle(name);
}
function $hideToggle(e) {
  e = $inEl(e);
  let display = e.style.display;
  e.style.display = display === "none" || display === "" ? "block" : "none";
}

function $click(e, func) {
  $inEl(e).addEventListener("click", func);
}
function $onload(e, func) {
  $inEl(e).addEventListener("DOMContentLoaded", func);
}
function $input(e, func) {
  $inEl(e).addEventListener("input", func);
}
function $elNext(e) {
  return e.nextElementSibling;
}

function $isStr(s) {
  return typeof s === "string";
}
// если в инпут строка то находим элементы
function $inEl(s) {
  return $isStr(s) ? $(s) : s;
}
function $inEls(s) {
  return $isStr(s) ? $$(s) : s;
}

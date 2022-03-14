function createPort(node) {
  var node = document.createElement("li");
  var dv = document.createElement("div");
  var sp = document.createElement("span");
  sp.className += "portLabel";
  var textnode = document.createTextNode("Portfolio X");
  sp.appendChild(textnode);
  node.appendChild(sp);
  var ur = document.getElementById("lis").appendChild(node);
  ur.className += "list-group-item";
  var n1 = document.createElement("a");
  var t1 = document.createTextNode("Edit");
  n1.style.color = "white";
  n1.href = "edit.html";
  n1.appendChild(t1);
  var x = ur.appendChild(n1);
  x.className += "btn btn-primary";
  dv.appendChild(n1);
  var n1 = document.createElement("button");
  var t1 = document.createTextNode("Delete");
  n1.style.color = "white";
  n1.setAttribute("onclick", "SomeDeleteRowFunction(this)");
  n1.appendChild(t1);
  var x = ur.appendChild(n1);
  x.className += "btn btn-primary";

  dv.style.cssFloat = "right";
  dv.appendChild(n1);
  node.appendChild(dv);
}

function deleteParent(o) {
  var p = o.parentNode.parentNode;
  p.parentNode.removeChild(p);
}
function toggleShare(el) {
  /* Get the text field */
  var copyText = el;

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  alert("Copied the text: " + copyText.value);
}

function searchResearch() {
  let input, filter, list, research, a, i, txtValue;
  input = document.getElementById("inputSearch");
  filter = input.value.toUpperCase();
  list = document.getElementById("listResearchs");
  research = list.getElementsByClassName("splide__slide");
  for (i = 0; i < research.length; i++) {
    a = research[i].getElementsByTagName("h4")[0];
    txtValue = a.textContent || a.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      research[i].style.display = "";
    } else {
      research[i].style.display = "none";
    }
  }
}

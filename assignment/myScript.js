  const sectionCount = 4; // Total number of sections
  let currentSection = 1; // Current section number

  const prevBtns = document.querySelectorAll(".prev-btn");
  const nextBtns = document.querySelectorAll(".next-btn");

  // Hide all previous buttons except the first
  for (let i = 1; i < currentSection; i++) {
    prevBtns[i-1].style.display = "none";
  }

  // Function to go to the next section
  function nextStep() {
    if (currentSection < sectionCount) {
      const currentSectionEl = document.getElementById("section" + currentSection);
      currentSectionEl.style.display = "none";

      currentSection++;
      const nextSectionEl = document.getElementById("section" + currentSection);
      nextSectionEl.style.display = "block";

      for (let i = 0; i < nextBtns.length; i++) {
        if (i == currentSection - 1) {
          nextBtns[i].style.display = "block";
        } else {
          nextBtns[i].style.display = "none";
        }
      }
    }
  }
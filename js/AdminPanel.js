

 //************** COUNTER ***********************

    const counters = document.querySelectorAll(".counter");
    const speed = 2000; // The lower the slower

    counters.forEach((counter) => {
      const updateCount = () => {
        const target = +counter.getAttribute("data-target");
        const count = +counter.innerText;

        // Lower inc to slow and higher to slow
        const inc = (target / speed) | 1;

        

        // Check if target is reached
        if (count < target) {
          // Add inc to count and output in counter
          counter.innerText = count + inc;
          // Call function every ms
          setTimeout(updateCount, 1);
        } else {
          counter.innerText = target;
        }
      };
      updateCount();
    });

     // *************** POPUP WINDOW *************

    function ResetBooksInfo() {
      // Make an HTTP request to the PHP file
      var exe = new XMLHttpRequest();
      exe.open("POST", "ResetBookInfo.php", true);
      exe.send();
      showPopup();
    }

    function showPopup() {
      document.getElementById("popup").style.display = "block";
    }

    function hidePopup() {
      document.getElementById("popup").style.display = "none";
      window.location.reload();
    }
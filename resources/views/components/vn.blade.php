{{-- resources/views/components/vn.blade.php --}}

<style>
#vn-container {
  position: fixed;
  bottom: 20px;
  left: 0;
  width: 100%;
  display: flex;
  justify-content: center; /* CENTER instead of full width */
  z-index: 99999;
}

.vn-hidden {
  display: none !important;
}

/* wrapper controls width */
.vn-wrapper {
  position: relative;
  width: clamp(600px, 75vw, 1100px);
  max-width: 1100px;
  padding-left: 300px; /* 🔥 push box right */
}

/* CHARACTER */
#vn-character {
  position: absolute;
  left: 0; /* push characters further left */
  bottom: 0;
  height: 260px;
  z-index: 2;
}

/* MAIN BOX */
.vn-box {
  position: relative;
  background: #f8f8f8;
  border-radius: 20px;
  padding: 12px;
  box-shadow: 0 15px 40px rgba(0,0,0,0.4);
}

/* INNER BORDER (THIS is what you wanted) */
.vn-inner {
  border: 2px solid #ddd;
  border-radius: 15px;
  padding: 16px 20px 50px 20px;
  background: white;
  min-height: 100px;
}

/* NAME TAG (floating style) */
.vn-name-tag {
  position: absolute;
  top: -16px;
  left: 20px;
  background: #2d6cdf;
  color: white;
  padding: 6px 16px;
  border-radius: 20px; /* smoother pill shape */
  font-weight: bold;
  box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}

/* TEXT */
#vn-text {
  line-height: 1.5;
  min-height: 60px;
  font-size: clamp(15px, 1.2vw, 18px);
}

/* NEXT BUTTON */
#vn-next {
  position: absolute;
  bottom: 15px;
  right: 20px;
  background: #2d6cdf;
  color: white;
  border: none;
  padding: 10px 16px;
  border-radius: 10px;
  cursor: pointer;
  font-size: clamp(13px, 1vw, 16px);
}

/* SKIP BUTTON */
#vn-skip {
  position: absolute;
  bottom: 15px;
  left: 20px;
  background: transparent;
  border: none;
  cursor: pointer;
  color: #555;
}

#vn-skip:hover {
  text-decoration: underline;
}

.vn-show {
  animation: vnFadeIn 0.3s ease;
}

@keyframes vnFadeIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* TEXT BLINK (optional subtle) */
.vn-cursor::after {
  content: "|";
  margin-left: 3px;
  animation: blink 1s infinite;
}

@keyframes blink {
  0%, 50%, 100% { opacity: 1; }
  25%, 75% { opacity: 0; }
}

/* mobile view */
@media (max-width: 768px) {
  .vn-wrapper {
    width: 90%;
  }

  #vn-character {
    display: none; /* hide teacher on small screens */
  }

  .vn-inner {
    padding: 16px 16px 50px 16px; /* reset spacing */
  }
}

#vn-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.6); /* darkness level */
  z-index: 99998; /* BELOW vn-container */
}

/* smooth fade */
#vn-overlay.vn-show {
  animation: fadeOverlay 0.3s ease forwards;
}

@keyframes fadeOverlay {
  from { opacity: 0; }
  to { opacity: 1; }
}

#vn-overlay {
  pointer-events: all;
}
</style>

<div id="vn-overlay" class="vn-hidden"></div>

<div id="vn-container" class="vn-hidden">

  <div class="vn-wrapper">
    
    <img id="vn-character" src="{{ asset('images/teacher.png') }}" />

    <div class="vn-box">
      
      <div class="vn-name-tag">
        <span id="vn-name">Guro Rafael</span>
      </div>

      <div class="vn-inner">
        <div id="vn-text"></div>
      </div>

      <button id="vn-next">Susunod ➤</button>
      <button id="vn-skip">Laktawan ⏭</button>

    </div>

  </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    let dialogue = [];
    let currentIndex = 0;

    let isTyping = false;
    let typingSpeed = 10; // lower = faster

    const vnContainer = document.getElementById("vn-container");
    const vnText = document.getElementById("vn-text");
    const vnNext = document.getElementById("vn-next");
    const vnSkip = document.getElementById("vn-skip");
    const vnOverlay = document.getElementById("vn-overlay");

    let fullText = "";
    let charIndex = 0;
    let typingInterval;

    let currentDialogueKey = null;

    window.startDialogue = function(dialogueArray, key = null) {
        dialogue = dialogueArray;
        currentIndex = 0;
        currentDialogueKey = key;

        vnContainer.classList.remove("vn-hidden");
        vnContainer.style.display = "flex";

        vnOverlay.classList.remove("vn-hidden");
        vnOverlay.classList.add("vn-show");

        showLine();
    }

    function showLine() {
        const currentLine = dialogue[currentIndex];

        // reset text
        vnText.innerText = "";
        vnText.classList.add("vn-cursor");

        if (typeof currentLine === "string") {
            fullText = currentLine;
        } else {
            fullText = currentLine.text;

            if (currentLine.name) {
                document.getElementById("vn-name").innerText = currentLine.name;
            }

            if (currentLine.image) {
                document.getElementById("vn-character").src = currentLine.image;
            }
        }

        charIndex = 0;
        isTyping = true;

        clearInterval(typingInterval);

        typingInterval = setInterval(() => {
            if (charIndex < fullText.length) {
                vnText.innerText += fullText.charAt(charIndex);
                charIndex++;
            } else {
                finishTyping();
            }
        }, typingSpeed);
    }

    function finishTyping() {
        clearInterval(typingInterval);
        vnText.innerText = fullText;
        vnText.classList.remove("vn-cursor");
        isTyping = false;
    }

    function endDialogue() {
        vnContainer.classList.add("vn-hidden");
        vnContainer.style.display = "none";

        vnOverlay.classList.remove("vn-show");
        vnOverlay.classList.add("vn-hidden");

        if (currentDialogueKey) {
            markSeen(currentDialogueKey);
        }
    }

    vnNext.addEventListener("click", () => {
        console.log("CLICKED NEXT");

        if (isTyping) {
            finishTyping();
            return;
        }

        currentIndex++;
        console.log("INDEX:", currentIndex, "TOTAL:", dialogue.length);

        if (currentIndex >= dialogue.length) {
            console.log("ENDING DIALOGUE");
            endDialogue();
            return;
        }

        showLine();
    });

    vnSkip.addEventListener("click", () => {
        endDialogue();
    });

});

function hasSeen(key) {
    return localStorage.getItem(key) === "true";
}

function markSeen(key) {
    localStorage.setItem(key, "true");
}
</script>
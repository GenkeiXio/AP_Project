# Typewriter & Typing Animation Patterns Found in Workspace

## Overview
Found **5 primary typing animation implementations** across the application, with variations for different use cases (narration, dialogue, activities).

---

## 1. **Professional Typewriter (mainmap.blade.php)**
**Location:** [mainmap.blade.php](mainmap.blade.php#L1195-L1250)  
**Use:** Visual Novel (VN) dialogue system  
**Speed:** 40ms per character (default)

### JavaScript Implementation
```javascript
let isTyping = false;
let typingTimeout = null;

function typeWriter(text, element, speed = 40) {
    // Character-by-character smooth typing
    let charIndex = 0;
    element.innerHTML = "";

    isTyping = true;

    // 🛑 STOP previous typing
    if (typingTimeout) {
        clearTimeout(typingTimeout);
    }

    function typeChar() {
        if (charIndex < text.length) {
            element.innerHTML += text.charAt(charIndex);
            charIndex++;
            typingTimeout = setTimeout(typeChar, speed);
        } else {
            isTyping = false;
            typingTimeout = null;
        }
    }

    typeChar();
}
```

### CSS Animation
```css
/* Text - Professional Typing Animation */
.vn-text {
    font-size: 16px;
    line-height: 1.85;
    font-weight: 500;
    color: #2a2a2a;
    min-height: 2.4em;
    word-spacing: 0.1em;
}
```

### Features
- ✅ Instant completion on click (if still typing)
- ✅ Prevents overlapping animations with timeout management
- ✅ Configurable speed parameter
- ✅ Character-by-character rendering

---

## 2. **Narration Page Typewriter (narration.blade.php)**
**Location:** [narration.blade.php](narration.blade.php#L290-L340)  
**Use:** Story introduction/narration pages  
**Speed:** 25ms per character (default)

### JavaScript Implementation
```javascript
const pages = [
    // Array of narrative text pages
    `Page text content here...`
];

let current = 0;
let typing = false;
let typingTimeout = null;

function typeWriter(text, element, speed = 25) {
    clearTimeout(typingTimeout);
    element.innerHTML = "";
    let i = 0;
    typing = true;

    function typingEffect() {
        if (i < text.length) {
            element.innerHTML += text.charAt(i);
            i++;
            typingTimeout = setTimeout(typingEffect, speed);
        } else {
            typing = false;
        }
    }

    typingEffect();
}

function nextPage() {
    const textEl = document.getElementById("text");

    if (typing) {
        clearTimeout(typingTimeout);
        textEl.innerHTML = pages[current];
        typing = false;
        return;
    }

    current++;

    if (current < pages.length) {
        typeWriter(pages[current], textEl);
    } else {
        document.getElementById("nextBtn").style.display = "none";
        document.getElementById("startBtn").style.display = "inline-block";
    }
}
```

### CSS - Cursor Animation
```css
/* ✨ CURSOR */
.cursor::after {
    content: "|";
    animation: blink 1s infinite;
}

@keyframes blink {
    0%, 50%, 100% { opacity: 1; }
    25%, 75% { opacity: 0; }
}
```

### Features
- ✅ Paginated text progression
- ✅ Click-to-skip or click-to-complete functionality
- ✅ Blinking cursor animation
- ✅ Page navigation with state management

---

## 3. **Narrator Speech (mod3_node2.blade.php)**
**Location:** [mod3_node2.blade.php](mod3_node2.blade.php#L651-L670)  
**Use:** Character narration in activities  
**Speed:** 32ms per character (default)

### JavaScript Implementation
```javascript
const narratorText = document.getElementById('narratorText');

function typeNarrator(text, speed = 32) {
    narratorText.textContent = '';
    let i = 0;
    
    const write = () => {
        if (i <= text.length) {
            narratorText.textContent = text.slice(0, i);
            i++;
            setTimeout(write, speed);
        }
    };
    
    write();
}
```

### Features
- ✅ Uses `textContent` instead of `innerHTML` (safer for plain text)
- ✅ Uses `slice()` for substring rendering (different approach)
- ✅ Simpler implementation than character concatenation
- ✅ Suitable for single-line narrator speech

---

## 4. **Activity Text Typing (Pre-Test Nodes)**
**Location:** [node3_activity.blade.php](node3_activity.blade.php#L975-L1010)  
**Use:** Activity introductions and prompts  
**Speed:** 18ms per character

### JavaScript Implementation
```javascript
let typingTimer = null;
let isTyping = false;

function typeLine(text) {
    // Clear any existing typing
    if (typingTimer) {
        clearInterval(typingTimer);
        typingTimer = null;
    }

    introText.textContent = '';
    let i = 0;
    isTyping = true;

    typingTimer = setInterval(() => {
        if (i < text.length) {
            introText.textContent += text[i];
            i++;
        } else {
            clearInterval(typingTimer);
            typingTimer = null;
            isTyping = false;
        }
    }, 18);  // 18ms = faster typing
}
```

### Typing State Management
```javascript
function handleNextClick() {
    if (isTyping) return;  // Prevent action while typing

    if (lineIndex >= lines.length - 1) {
        introStage.style.display = 'none';
        gameStage.style.display = 'grid';
        updateCard();
        return;
    }
    lineIndex += 1;
    typeLine(lines[lineIndex]);
}
```

### Features
- ✅ Uses `setInterval` instead of `setTimeout`
- ✅ Faster typing speed (18ms per character)
- ✅ State guard to prevent interaction during typing
- ✅ Multi-line progression support

---

## 5. **Typing Status Indicator (mod3_node2.blade.php)**
**Location:** [mod3_node2.blade.php](mod3_node2.blade.php#L154-L160)  
**Use:** Input fields with visual typing feedback

### CSS - Blinking Caret
```css
.typing {
    display: block;
    width: 100%;
    white-space: normal;
    line-height: 1.5;
    position: relative;
}

.typing::after {
    content: '|';
    margin-left: 2px;
    color: #3f8e7f;
    animation: caretBlink 0.7s step-end infinite;
}

@keyframes caretBlink {
    50% { opacity: 0; }
}
```

### Features
- ✅ CSS-only blinking caret (no JavaScript)
- ✅ `step-end` timing function for mechanical feel
- ✅ Styled with custom color
- ✅ Uses pseudo-element for clean implementation

---

## CSS Animation Keyframes (Reusable)

### Blinking Animations
```css
/* Smooth blink (narration) */
@keyframes blink {
    0%, 50%, 100% { opacity: 1; }
    25%, 75% { opacity: 0; }
}

/* Step blink (typing indicator) */
@keyframes caretBlink {
    50% { opacity: 0; }
}

/* Fade in text */
@keyframes fadeText {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Text fade out */
@keyframes fadeOut {
    to {
        opacity: 0;
        transform: scale(1.05);
    }
}
```

---

## Speed Comparison Table

| Implementation | Speed (ms) | Use Case | Method |
|---|---|---|---|
| Narration (narration.blade.php) | 25 | Story pages | setTimeout |
| VN Dialogue (mainmap.blade.php) | 40 | Dialogue boxes | setTimeout |
| Narrator (mod3_node2.blade.php) | 32 | NPC speech | setTimeout |
| Activities (Pre-Test) | 18 | Game text | setInterval |

---

## Common Patterns

### 1. **Interruption Handling**
All implementations support clicking to complete or skip:
```javascript
if (isTyping) {
    clearTimeout(typingTimeout);  // or clearInterval
    element.innerHTML = fullText;  // Show complete text
    isTyping = false;
    return;
}
```

### 2. **Text Concatenation Methods**
- **Method 1:** `element.innerHTML += text.charAt(i)`
- **Method 2:** `element.innerHTML += text[i]`
- **Method 3:** `element.textContent = text.slice(0, i)`

### 3. **State Management**
All use flag variables to track typing state:
```javascript
let isTyping = false;      // Boolean flag
let typingTimer = null;    // Timer reference
let charIndex = 0;         // Character position
```

---

## Recommendations for Reusable Library

### Suggested Parameters
```javascript
class TypewriterEffect {
    constructor(options = {}) {
        this.speed = options.speed || 25;           // ms per character
        this.element = options.element;             // DOM element
        this.onComplete = options.onComplete;       // Callback
        this.clickToComplete = options.clickToComplete ?? true;
        this.useTextContent = options.useTextContent ?? false;
    }
}
```

### Features to Include
- ✅ Configurable speed
- ✅ Callback on completion
- ✅ Click-to-skip functionality
- ✅ Queue multiple texts
- ✅ Pause/resume support
- ✅ Optional HTML rendering vs text-only mode

---

## Files Using These Patterns

1. **[narration.blade.php](narration.blade.php)** - Main narration page
2. **[mainmap.blade.php](mainmap.blade.php)** - VN dialogue system
3. **[mod3_node2.blade.php](mod3_node2.blade.php)** - Activity narration
4. **[node3_activity.blade.php](node3_activity.blade.php)** - Pre-test activities
5. **[node2_activity.blade.php](node2_activity.blade.php)** - Pre-test activities
6. **[Node1_Solid Waste.blade.php](Pre-Test/Node1_Solid%20Waste.blade.php)** - Pre-test activities

---

## CSS Files with Text Animations
- [narration.css](public/css/narration.css)
- [home.css](public/css/home.css) - Contains spinner animations

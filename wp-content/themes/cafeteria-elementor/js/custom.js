// Menu
function cafeteria_elementor_openNav() {
  jQuery(".sidenav").addClass('show');
}
function cafeteria_elementor_closeNav() {
  jQuery(".sidenav").removeClass('show');
}

( function( window, document ) {
  function cafeteria_elementor_keepFocusInMenu() {
    document.addEventListener( 'keydown', function( e ) {
      const cafeteria_elementor_nav = document.querySelector( '.sidenav' );

      if ( ! cafeteria_elementor_nav || ! cafeteria_elementor_nav.classList.contains( 'show' ) ) {
        return;
      }
      const elements = [...cafeteria_elementor_nav.querySelectorAll( 'input, a, button' )],
        cafeteria_elementor_lastEl = elements[ elements.length - 1 ],
        cafeteria_elementor_firstEl = elements[0],
        cafeteria_elementor_activeEl = document.activeElement,
        tabKey = e.keyCode === 9,
        shiftKey = e.shiftKey;

      if ( ! shiftKey && tabKey && cafeteria_elementor_lastEl === cafeteria_elementor_activeEl ) {
        e.preventDefault();
        cafeteria_elementor_firstEl.focus();
      }

      if ( shiftKey && tabKey && cafeteria_elementor_firstEl === cafeteria_elementor_activeEl ) {
        e.preventDefault();
        cafeteria_elementor_lastEl.focus();
      }
    } );
  }
  cafeteria_elementor_keepFocusInMenu();
} )( window, document );


document.addEventListener('DOMContentLoaded', function () {
  var cafeteria_elementor_preloader = document.getElementById('preloader');

  if (cafeteria_elementor_preloader) {  // Check if the element exists before trying to manipulate it
      var duration = 4000; // 10 seconds

      setTimeout(function () {
        cafeteria_elementor_preloader.style.display = 'none';
      }, duration);
  }
});

// Header Search

function cafeteria_elementor_search_show() {
	jQuery(".external-search").addClass('show');
	jQuery(".external-search").fadeIn();
}
jQuery( ".search-container-button").on("click", cafeteria_elementor_search_show);

function cafeteria_elementor_search_hide() {
	jQuery(".external-search").removeClass('show');
	jQuery(".external-search").fadeOut();
}
jQuery( ".search-container-button-close").on("click", cafeteria_elementor_search_hide);

jQuery('.search-container-button-close').on('keydown', function (es) {
  if (jQuery("this:focus") && (es.which === 9)) {
    es.preventDefault();
    jQuery(this).blur();
    jQuery('.internal-search form input').focus();
  }
});

jQuery('.internal-search form input').on('keydown', function (eventser) {
  if (eventser.shiftKey && eventser.keyCode == 9) {
    eventser.preventDefault();
    jQuery(this).blur();
    jQuery('.search-container-button-close').focus()
  }
});

/* Custom Cursor
 **-----------------------------------------------------*/
const cafeteria_elementor_customCursor = {
  init: function () {
    this.cafeteria_elementor_customCursor();
  },
  isVariableDefined: function (el) {
    return typeof el !== "undefined" && el !== null;
  },
  select: function (selectors) {
    return document.querySelector(selectors);
  },
  selectAll: function (selectors) {
    return document.querySelectorAll(selectors);
  },
  cafeteria_elementor_customCursor: function () {
    const cafeteria_elementor_cursorDot = this.select(".cursor-point");
    const cafeteria_elementor_cursorOutline = this.select(".cursor-point-outline");
    if (this.isVariableDefined(cafeteria_elementor_cursorDot) && this.isVariableDefined(cafeteria_elementor_cursorOutline)) {
      const cursor = {
        delay: 8,
        _x: 0,
        _y: 0,
        endX: window.innerWidth / 2,
        endY: window.innerHeight / 2,
        cursorVisible: true,
        cursorEnlarged: false,
        $dot: cafeteria_elementor_cursorDot,
        $outline: cafeteria_elementor_cursorOutline,

        init: function () {
          this.dotSize = this.$dot.offsetWidth;
          this.outlineSize = this.$outline.offsetWidth;
          this.setupEventListeners();
          this.animateDotOutline();
        },

        updateCursor: function (e) {
          this.cursorVisible = true;
          this.toggleCursorVisibility();
          this.endX = e.clientX;
          this.endY = e.clientY;
          this.$dot.style.top = `${this.endY}px`;
          this.$dot.style.left = `${this.endX}px`;
        },

        setupEventListeners: function () {
          window.addEventListener("load", () => {
            this.cursorEnlarged = false;
            this.toggleCursorSize();
          });

          cafeteria_elementor_customCursor.selectAll("a, button").forEach((el) => {
            el.addEventListener("mouseover", () => {
              this.cursorEnlarged = true;
              this.toggleCursorSize();
            });
            el.addEventListener("mouseout", () => {
              this.cursorEnlarged = false;
              this.toggleCursorSize();
            });
          });

          document.addEventListener("mousedown", () => {
            this.cursorEnlarged = true;
            this.toggleCursorSize();
          });
          document.addEventListener("mouseup", () => {
            this.cursorEnlarged = false;
            this.toggleCursorSize();
          });

          document.addEventListener("mousemove", (e) => {
            this.updateCursor(e);
          });

          document.addEventListener("mouseenter", () => {
            this.cursorVisible = true;
            this.toggleCursorVisibility();
            this.$dot.style.opacity = 1;
            this.$outline.style.opacity = 1;
          });

          document.addEventListener("mouseleave", () => {
            this.cursorVisible = false;
            this.toggleCursorVisibility();
            this.$dot.style.opacity = 0;
            this.$outline.style.opacity = 0;
          });
        },

        animateDotOutline: function () {
          this._x += (this.endX - this._x) / this.delay;
          this._y += (this.endY - this._y) / this.delay;
          this.$outline.style.top = `${this._y}px`;
          this.$outline.style.left = `${this._x}px`;

          requestAnimationFrame(this.animateDotOutline.bind(this));
        },

        toggleCursorSize: function () {
          if (this.cursorEnlarged) {
            this.$dot.style.transform = "translate(-50%, -50%) scale(0.75)";
            this.$outline.style.transform = "translate(-50%, -50%) scale(1.6)";
          } else {
            this.$dot.style.transform = "translate(-50%, -50%) scale(1)";
            this.$outline.style.transform = "translate(-50%, -50%) scale(1)";
          }
        },

        toggleCursorVisibility: function () {
          if (this.cursorVisible) {
            this.$dot.style.opacity = 1;
            this.$outline.style.opacity = 1;
          } else {
            this.$dot.style.opacity = 0;
            this.$outline.style.opacity = 0;
          }
        },
      };
      cursor.init();
    }
  },
};
cafeteria_elementor_customCursor.init();

//scrollToTop

const cafeteria_elementor_scrollToTop = {
  scrollToTop: {
    init() {
      this.button = document.getElementById("scrollToTopBtn");
      const svg = document.getElementById("progressCircle");
      this.circle = svg?.querySelector("circle");

      if (!this.button || !this.circle) return;

      this.radius = this.circle.r.baseVal.value;
      this.circumference = 2 * Math.PI * this.radius;

      this.circle.style.strokeDasharray = `${this.circumference}`;
      this.circle.style.strokeDashoffset = this.circumference;

      window.addEventListener("scroll", this.handleScroll.bind(this));
      this.button.addEventListener("click", this.scrollToTop.bind(this));
    },

    handleScroll() {
      const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;

      this.button.style.display = scrollTop > 100 ? "flex" : "none";
      requestAnimationFrame(this.updateProgress.bind(this));
    },

    scrollToTop() {
      window.scrollTo({ top: 0, behavior: "smooth" });
    },

    updateProgress() {
      if (!this.circle) return;

      const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
      const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
      const progress = scrollTop / scrollHeight;

      const offset = this.circumference * (1 - progress);
      this.circle.style.strokeDashoffset = offset;
    }
  }
};
document.addEventListener("DOMContentLoaded", () => cafeteria_elementor_scrollToTop .scrollToTop.init());
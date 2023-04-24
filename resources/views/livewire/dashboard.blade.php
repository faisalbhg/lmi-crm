 @push('custom_css')
 <link rel="stylesheet" type="text/css" href="{{asset('css/calender-crm.css?v=0.2');}}">
@endpush
 <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <div class="container-fluid py-4">
      <div class="row py-4">
        <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <a href="{{ route('crm') }}">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Customers</p>
                    <h5 class="font-weight-bolder text-sm mb-0">Total: 
                      <span class="text-success text-lg font-weight-bolder">{{$status->customers}}</span>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-light shadow text-center border-radius-md">
                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
              </a>
            </div>
          </div>
        </div>

        <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <a href="{{ route('crm') }}">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">View All CRM</p>
                    <h5 class="font-weight-bolder text-sm mb-0">Total: 
                      <span class="text-success text-lg font-weight-bolder">{{$status->total}}</span>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
              </a>
            </div>
          </div>
        </div>

        <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total New</p>
                    <h5 class="font-weight-bolder mb-0">
                      
                      <span class="text-dark text-lg font-weight-bolder">{{$status->new}}</span>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md">
                    <svg width="20px" height="45px" viewBox="0 0 40 44" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <title>document</title>
                      <g id="Basic-Elements" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Rounded-Icons" transform="translate(-1870.000000, -591.000000)" fill="#FFFFFF" fill-rule="nonzero">
                          <g id="Icons-with-opacity" transform="translate(1716.000000, 291.000000)">
                            <g id="document" transform="translate(154.000000, 300.000000)">
                              <path class="color-background" d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z" id="Path" opacity="0.603585379"></path>
                              <path class="color-background" d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z" id="Shape"></path>
                            </g>
                          </g>
                        </g>
                      </g>
                    </svg>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">On Going</p>
                    <h5 class="font-weight-bolder mb-0">
                      
                      <span class="text-info text-lg font-weight-bolder">{{$status->followup+$status->quotation}}</span>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                    <svg width="20px" height="45px" viewBox="0 0 40 44" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <title>document</title>
                      <g id="Basic-Elements" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Rounded-Icons" transform="translate(-1870.000000, -591.000000)" fill="#FFFFFF" fill-rule="nonzero">
                          <g id="Icons-with-opacity" transform="translate(1716.000000, 291.000000)">
                            <g id="document" transform="translate(154.000000, 300.000000)">
                              <path class="color-background" d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z" id="Path" opacity="0.603585379"></path>
                              <path class="color-background" d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z" id="Shape"></path>
                            </g>
                          </g>
                        </g>
                      </g>
                    </svg>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Won</p>
                    <h5 class="font-weight-bolder mb-0">
                      
                      <span class="text-success text-lg font-weight-bolder">{{$status->won}}</span>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                    <svg width="20px" height="45px" viewBox="0 0 40 44" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <title>document</title>
                      <g id="Basic-Elements" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Rounded-Icons" transform="translate(-1870.000000, -591.000000)" fill="#FFFFFF" fill-rule="nonzero">
                          <g id="Icons-with-opacity" transform="translate(1716.000000, 291.000000)">
                            <g id="document" transform="translate(154.000000, 300.000000)">
                              <path class="color-background" d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z" id="Path" opacity="0.603585379"></path>
                              <path class="color-background" d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z" id="Shape"></path>
                            </g>
                          </g>
                        </g>
                      </g>
                    </svg>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Loss</p>
                    <h5 class="font-weight-bolder mb-0">
                      
                      <span class="text-danger text-lg font-weight-bolder">{{$status->loss}}</span>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md">
                    <svg width="20px" height="45px" viewBox="0 0 40 44" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <title>document</title>
                      <g id="Basic-Elements" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Rounded-Icons" transform="translate(-1870.000000, -591.000000)" fill="#FFFFFF" fill-rule="nonzero">
                          <g id="Icons-with-opacity" transform="translate(1716.000000, 291.000000)">
                            <g id="document" transform="translate(154.000000, 300.000000)">
                              <path class="color-background" d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z" id="Path" opacity="0.603585379"></path>
                              <path class="color-background" d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z" id="Shape"></path>
                            </g>
                          </g>
                        </g>
                      </g>
                    </svg>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr class="ct-docs-hr">

      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-sm-0 pt-2">
          <div class="widget-calendar h-100">
            <!-- Card body -->
            <div class="border-radius-lg" id="calendar"></div>
            
          </div>
        </div>
      </div>
    </div>
  </main>

@push('custom_script')
  <!--   Core JS Files   -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>
  <script src="{{asset('js/plugins/fullcalendar.min.js')}}"></script>
  <script type="text/javascript">
    !function () {
      var today = moment();

      function Calendar(selector, events) {
        this.el = document.querySelector(selector);
        this.events = events;
        this.current = moment().date(1);
        this.draw();
        var current = document.querySelector('.today');
        if (current) {
          var self = this;
          window.setTimeout(function () {
            self.openDay(current);
          }, 500);
        }
      }

      Calendar.prototype.draw = function () {
        //Create Header
        this.drawHeader();

        //Draw Month
        this.drawMonth();

        //
        //this.drawLegend();
      }

      Calendar.prototype.drawHeader = function () {
        var self = this;
        if (!this.header) {
          //Create the header elements
          this.header = createElement('div', 'header');
          this.header.className = 'header';

          this.title = createElement('h1');
          this.title.addEventListener('click', function () {
             self.curMonth();
          });

          var right = createElement('div', 'right');
          right.addEventListener('click', function () {
            self.nextMonth();
          });

          var left = createElement('div', 'left');
          left.addEventListener('click', function () {
            self.prevMonth();
          });

          //Append the Elements
          this.header.appendChild(this.title);
          this.header.appendChild(right);
          this.header.appendChild(left);
          this.el.appendChild(this.header);
        }

        this.title.innerHTML = this.current.format('MMMM YYYY');
      }

      Calendar.prototype.drawMonth = function () {
        var self = this;

        this.events.forEach(function (ev) {
        //  ev.date = self.current.clone().date(Math.random() * (29 - 1) + 1);
          ev.date = moment(ev.eventTime, "YYYY-MM-DD");
        });


        if (this.month) {
          this.oldMonth = this.month;
          this.oldMonth.className = 'month out ' + (self.next ? 'next' : 'prev');
          this.oldMonth.addEventListener('animationend', function () {
            self.oldMonth.parentNode.removeChild(self.oldMonth);
            self.month = createElement('div', 'month');
            self.backFill();
            self.currentMonth();
            self.fowardFill();
            self.el.appendChild(self.month);
            window.setTimeout(function () {
              self.month.className = 'month in ' + (self.next ? 'next' : 'prev');
            }, 16);
          });
        } else {
          this.month = createElement('div', 'month');
          this.el.appendChild(this.month);
          this.backFill();
          this.currentMonth();
          this.fowardFill();
          this.month.className = 'month new';
        }
      }

      Calendar.prototype.backFill = function () {
        var clone = this.current.clone();
        var dayOfWeek = clone.day() - 1;

        if (dayOfWeek == -1)
          dayOfWeek = 6;

        if (!dayOfWeek) {
          return;
        }

        clone.subtract('days', dayOfWeek + 1);

        for (var i = dayOfWeek; i > 0; i--) {
          this.drawDay(clone.add('days', 1));
        }
      }

      Calendar.prototype.fowardFill = function () {
        var clone = this.current.clone().add('months', 1).subtract('days', 1);
        var dayOfWeek = clone.day();

        if (dayOfWeek === 7) {
          return;
        }

        for (var i = dayOfWeek; i < 7; i++) {
          this.drawDay(clone.add('days', 1));
        }
      }

      Calendar.prototype.currentMonth = function () {
        var clone = this.current.clone();

        while (clone.month() === this.current.month()) {
          this.drawDay(clone);
          clone.add('days', 1);
        }
      }

      Calendar.prototype.getWeek = function (day) {
        if (!this.week || day.day() === 1) {
          this.week = createElement('div', 'week');
          this.month.appendChild(this.week);
        }
      }

      Calendar.prototype.drawDay = function (day) {
        var self = this;
        this.getWeek(day);

        //Outer Day
        var clickState = 0;
        var outer = createElement('div', this.getDayClass(day));
        outer.addEventListener('click', function () {
          if ( this.classList.contains('active') ) {
             self.closeDay(this);
          } 
          else {
             self.openDay(this);
          }
        
        });

        //Day Name
        var name = createElement('div', 'day-name', day.format('ddd'));

        //Day Number
        var number = createElement('div', 'day-number', day.format('DD'));


        //Events
        var events = createElement('div', 'day-events');
        this.drawEvents(day, events);

        outer.appendChild(name);
        outer.appendChild(number);
        outer.appendChild(events);
        this.week.appendChild(outer);
      }

      Calendar.prototype.drawEvents = function (day, element) {
        if (day.month() === this.current.month()) {
          var todaysEvents = this.events.reduce(function (memo, ev) {
            if (ev.date.isSame(day, 'day')) {
              memo.push(ev);
            }
            return memo;
          }, []);

          todaysEvents.forEach(function (ev) {
            var evSpan = createElement('span', ev.color);
            element.appendChild(evSpan);
          });
        }
      }

      Calendar.prototype.getDayClass = function (day) {
        classes = ['day'];
        if (day.month() !== this.current.month()) {
          classes.push('other');
        } else if (today.isSame(day, 'day')) {
          classes.push('today');
        }
        return classes.join(' ');
      }

      Calendar.prototype.closeDay = function (el) {
        // var details, arrow;
        // var dayNumber = +el.querySelectorAll('.day-number')[0].innerText || +el.querySelectorAll('.day-number')[0].textContent;
        // var day = this.current.clone().date(dayNumber);
        var daysActive = document.querySelectorAll(".day.active");
        [].forEach.call(daysActive, function(i) {
          i.classList.remove("active");
        });
        var currentOpened = document.querySelector('.details');
    
        if (currentOpened) {
          currentOpened.addEventListener('webkitAnimationEnd', function () {
            currentOpened.parentNode.removeChild(currentOpened);
          });
          currentOpened.addEventListener('oanimationend', function () {
            currentOpened.parentNode.removeChild(currentOpened);
          });
          currentOpened.addEventListener('msAnimationEnd', function () {
            currentOpened.parentNode.removeChild(currentOpened);
          });
          currentOpened.addEventListener('animationend', function () {
            currentOpened.parentNode.removeChild(currentOpened);
          });
          currentOpened.className = 'details out';
        }
      }

      Calendar.prototype.openDay = function (el) {
        var details, arrow;
        var dayNumber = +el.querySelectorAll('.day-number')[0].innerText || +el.querySelectorAll('.day-number')[0].textContent;
        var day = this.current.clone().date(dayNumber);

        var daysActive = document.querySelectorAll(".day.active");

        [].forEach.call(daysActive, function(i) {
          i.classList.remove("active");
        });
        el.classList.add('active');

        var currentOpened = document.querySelector('.details');
    
        //Check to see if there is an open detais box on the current row
        if (currentOpened && currentOpened.parentNode === el.parentNode) {
          details = currentOpened;
          arrow = document.querySelector('.arrow');
        
        } else {
          //Close the open events on differnt week row
          //currentOpened && currentOpened.parentNode.removeChild(currentOpened);
         //  el.classList.remove('active');
          if (currentOpened) {
            currentOpened.addEventListener('webkitAnimationEnd', function () {
              currentOpened.parentNode.removeChild(currentOpened);
            });
            currentOpened.addEventListener('oanimationend', function () {
              currentOpened.parentNode.removeChild(currentOpened);
            });
            currentOpened.addEventListener('msAnimationEnd', function () {
              currentOpened.parentNode.removeChild(currentOpened);
            });
            currentOpened.addEventListener('animationend', function () {
              currentOpened.parentNode.removeChild(currentOpened);
            });
            currentOpened.className = 'details out';
           
          }

          //Create the Details Container
          details = createElement('div', 'details in');

          //Create the arrow
          var arrow = createElement('div', 'arrow');

          //Create the event wrapper

          details.appendChild(arrow);
          el.parentNode.appendChild(details);
        }

        var todaysEvents = this.events.reduce(function (memo, ev) {
          if (ev.date.isSame(day, 'day')) {
            memo.push(ev);
          }
          return memo;
        }, []);

        this.renderEvents(todaysEvents, details);

        arrow.style.left = el.offsetLeft - el.parentNode.offsetLeft + 27 + 'px';
      }

      Calendar.prototype.renderEvents = function (events, ele) {
        //Remove any events in the current details element
        var currentWrapper = ele.querySelector('.events');
        var wrapper = createElement('div', 'events in' + (currentWrapper ? ' new' : ''));

        events.forEach(function (ev) {
          var div = createElement('div', 'event');
          var square = createElement('div', 'event-category ' + ev.color);
          var span = createElement('span', '', ev.eventName);
          var alink = createElement('a', '', ev.eventUrl);

          div.appendChild(square);
          div.appendChild(span);
          div.appendChild(alink);
          wrapper.appendChild(div);
        });

        if (!events.length) {
          var div = createElement('div', 'event empty');
          var span = createElement('span', '', 'No Events');
          var alink = createElement('a', '', 'No Link');

          div.appendChild(span);
          span.appendChild(alink);
          wrapper.appendChild(div);
        }

        if (currentWrapper) {
          currentWrapper.className = 'events out';
          currentWrapper.addEventListener('webkitAnimationEnd', function () {
            currentWrapper.parentNode.removeChild(currentWrapper);
            ele.appendChild(wrapper);
          });
          currentWrapper.addEventListener('oanimationend', function () {
            currentWrapper.parentNode.removeChild(currentWrapper);
            ele.appendChild(wrapper);
          });
          currentWrapper.addEventListener('msAnimationEnd', function () {
            currentWrapper.parentNode.removeChild(currentWrapper);
            ele.appendChild(wrapper);
          });
          currentWrapper.addEventListener('animationend', function () {
            currentWrapper.parentNode.removeChild(currentWrapper);
            ele.appendChild(wrapper);
          });
        } else {
          ele.appendChild(wrapper);
        }
      }

      Calendar.prototype.drawLegend = function () {
        var legend = createElement('div', 'legend');
        var calendars = this.events.map(function (e) {
          return e.calendar + '|' + e.color;
        }).reduce(function (memo, e) {
          if (memo.indexOf(e) === -1) {
            memo.push(e);
          }
          return memo;
        }, []).forEach(function (e) {
          var parts = e.split('|');
          var entry = createElement('span', 'entry ' + parts[1], parts[0]);
          legend.appendChild(entry);
        });
        this.el.appendChild(legend);
      }

      Calendar.prototype.nextMonth = function () {
        this.current.add('months', 1);
        this.next = true;
        this.draw();
      }

      Calendar.prototype.prevMonth = function () {
        this.current.subtract('months', 1);
        this.next = false;
        this.draw();
      }
      
      Calendar.prototype.curMonth = function () {
        this.current = moment().date(1);
        this.draw();
      }

      window.Calendar = Calendar;

      function createElement(tagName, className, innerText) {
        var ele = document.createElement(tagName);
        if (className) {
          ele.className = className;
        }
        if(tagName == 'a')
        {
          if (innerText!='No Link') {
            ele.innderText = ele.textContent = ' Open';
            ele.href = innerText;
          }
          else
          {
            ele.innderText = ele.textContent = '';
          }

        }
        else
        {
          if (innerText) {
            ele.innderText = ele.textContent = innerText;
          }
        }
        return ele;
      }
    }();

    !function () {
      var data = [
        <?php
        foreach($crmEntries as $crmEntry)
        {
      if($crmEntry->crm_reminder==1)
          {
            $followUpMsg = 'Reminder - ';
            $crmDateTime = \Carbon\Carbon::parse($crmEntry->crm_remind_on)->format('Y-m-d');
          }
          else
          {
            $followUpMsg = '';
            $crmDateTime = \Carbon\Carbon::parse($crmEntry->crm_updation_date_time)->format('Y-m-d');
          }
          
      /*else
          {
            $followUpMsg = 'Reminder - ';
            $crmDateTime = date("Y-m-d",strtotime($crmEntry->crm_remind_on));
          }*/
          
          ?>
          {
            eventName: '{{$followUpMsg.config('common.crmRelatedTo')[$crmEntry->related_to]}}, in {{$crmEntry->company}}, on Date: {{$crmDateTime}}', calendar: '{{config('common.crmRelatedTo')[$crmEntry->related_to]}}', color: '{{config('common.crmRelatedToColor')[$crmEntry->related_to]}}', eventTime: moment("{{$crmDateTime}}"),eventUrl:''},
          <?php
        }
        ?>
        /*{eventName: 'Lunch Meeting w/ Mark', calendar: 'Work', color: 'white', eventTime: moment("2021-08-16")},
        {eventName: 'Interview - Jr. Web Developer', calendar: 'Work', color: 'orange', eventTime: moment("2021-08-16")},
        {eventName: 'Demo New App to the Board', calendar: 'Work', color: 'orange', eventTime: moment("2021-08-1")},
        {eventName: 'Dinner w/ Marketing', calendar: 'Work', color: 'orange', eventTime: moment("2021-08-30")},

        {eventName: 'Game vs Portalnd', calendar: 'Sports', color: 'blue', eventTime: moment("2021-08-16")},
        {eventName: 'Game vs Houston', calendar: 'Sports', color: 'blue', eventTime: moment("2021-08-5")},
        {eventName: 'Game vs Denver', calendar: 'Sports', color: 'blue', eventTime: moment("2021-08-8")},
        {eventName: 'Game vs San Degio', calendar: 'Sports', color: 'blue', eventTime: moment("2021-08-10")},

        {eventName: 'School Play', calendar: 'Kids', color: 'yellow', eventTime: moment("2021-08-16")},
        {eventName: 'Parent/Teacher Conference', calendar: 'Kids', color: 'yellow', eventTime: moment("2021-08-13")},
        {eventName: 'Pick up from Soccer Practice', calendar: 'Kids', color: 'yellow', eventTime: moment("2021-08-26")},
        {eventName: 'Ice Cream Night', calendar: 'Kids', color: 'yellow', eventTime: moment("2021-08-22")},

        {eventName: 'Free Tamale Night', calendar: 'Other', color: 'green', eventTime: moment("2021-058-16")},
        {eventName: 'Bowling Team', calendar: 'Other', color: 'green', eventTime: moment("2021-08-27")},
        {eventName: 'Teach Kids to Code', calendar: 'Other', color: 'green', eventTime: moment("2021-08-19")},
        {eventName: 'Startup Weekend', calendar: 'Other', color: 'green', eventTime: moment("2021-08-31")}*/
      ];



      function addDate(ev) {

      }

      var calendar = new Calendar('#calendar', data);

    }();                  

  </script>

@endpush
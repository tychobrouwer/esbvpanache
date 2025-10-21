<div class="relative" x-data="datetimePicker()" x-init="[initDate(), getNoOfDays()]" x-cloak x-modelable="datepickerValue">
    <div class="flex items-center" @click="showDatepicker = !showDatepicker" @keydown.escape="showDatepicker = false">
        <input type="text" readonly x-model="datepickerValue" @keydown.escape="showDatepicker = false" class="mt-1 block w-full border border-gray-300 rounded-sm shadow-sm focus:ring-panache focus:border-panache sm:text-sm" placeholder="Select date">

        <svg class="cursor-text mt-1 ml-[-32px] w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
    </div>

    <div class="bg-gray-100 p-3 rounded-lg shadow-sm sm:rounded-lg absolute mt-1" style="width: 17rem"
        x-show.transition="showDatepicker" @click.away="showDatepicker = false">

        <div class="flex justify-between items-center mb-3">
            <div>
                <span x-text="MONTH_NAMES[month]" class="text-lg font-bold text-gray-800"></span>
                <span x-text="year" class="ml-1 text-lg text-gray-600 font-normal"></span>
            </div>
            <div>
                <button type="button"
                    class="inline-flex cursor-pointer hover:bg-panache p-1 rounded-full transition ease-in-out duration-150" @click="decrementMonth()">
                    <svg class="h-4 w-4 text-gray-800 hover:text-gray-100 inline-flex" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button type="button"
                    class="inline-flex cursor-pointer hover:bg-panache p-1 rounded-full transition ease-in-out duration-150" @click="incrementMonth()">
                    <svg class="h-4 w-4 text-gray-800 hover:text-gray-100 inline-flex" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="flex flex-wrap mb-3">
            <template x-for="(day, index) in DAYS" :key="index">
                <div class="w-[14.28%] px-1">
                    <div x-text="day" class="text-gray-800 font-medium text-center text-xs"></div>
                </div>
            </template>
        </div>

        <div class="flex flex-wrap">
            <template x-for="blankday in blankdays">
                <div class="w-[14.28%] text-center border p-1 border-transparent text-sm aspect-square">
                </div>
            </template>
            <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">
                <div class="w-[14.28%] px-1 mb-1">
                    <div @click="getDateValue(date)" x-text="date"
                        class="cursor-pointer text-center text-sm rounded-full aspect-square flex items-center justify-center pt-[2px] transition ease-in-out duration-150"
                        :class="{
                            'bg-panache text-gray-100': isToday(date) == true,
                            'text-gray-800 hover:text-gray-100 hover:bg-panache': isToday(date) == false
                        }">
                    </div>
                </div>
            </template>
        </div>
    </div>
    <script>
        const MONTH_NAMES = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
            'October', 'November', 'December'
        ];
        const DAYS = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        function datetimePicker() {
            return {
                showDatepicker: false,
                datepickerValue: '',

                month: '',
                year: '',
                no_of_days: [],
                blankdays: [],
                days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],

                initDate() {
                    let today = new Date();
                    this.month = today.getMonth();
                    this.year = today.getFullYear();
                    
                    // Don't set default value, let x-model handle initialization
                    if (!this.datepickerValue) {
                        this.datepickerValue = '';
                    }
                },

                isToday(date) {
                    const today = new Date();
                    const d = new Date(this.year, this.month, date);

                    return today.toDateString() === d.toDateString() ? true : false;
                },

                incrementMonth() {
                    if (this.month == 11) {
                        this.month = 0;
                        this.year++;
                    } else {
                        this.month++;
                    }
                    this.getNoOfDays();
                },

                decrementMonth() {
                    if (this.month == 0) {
                        this.month = 11;
                        this.year--;
                    } else {
                        this.month--;
                    }
                    this.getNoOfDays();
                },

                getDateValue(date) {
                    let selectedDate = new Date(this.year, this.month, date);
                    
                    // Format as d-m-yyyy to match your form's expected format
                    this.datepickerValue = selectedDate.getDate() + "-" + (selectedDate.getMonth() + 1) + "-" + selectedDate.getFullYear();

                    this.showDatepicker = false;
                },

                getNoOfDays() {
                    let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();

                    // find where to start calendar day of week
                    let dayOfWeek = new Date(this.year, this.month).getDay();
                    let blankdaysArray = [];
                    for (var i = 1; i <= dayOfWeek; i++) {
                        blankdaysArray.push(i);
                    }

                    let daysArray = [];
                    for (var i = 1; i <= daysInMonth; i++) {
                        daysArray.push(i);
                    }

                    this.blankdays = blankdaysArray;
                    this.no_of_days = daysArray;
                }
            }
        }
    </script>

</div>
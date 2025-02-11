<template>

  <div class="min-h-full">
      <div class="bg-base-100 pb-32">
        <Disclosure as="nav" class="border-b border-indigo-300/25 bg-base-100 lg:border-none" v-slot="{ open }">
          <div class="mx-auto max-w-7xl px-2 sm:px-4 lg:px-8">
            <div class="relative flex h-16 items-center justify-between lg:border-b lg:border-accent">
              <div class="flex items-center px-2 lg:px-0">
                <div class="shrink-0">
                  <Link :href="route('dashboard')">
                                      <ApplicationLogo
                                          class="block h-9 w-auto fill-current text-gray-800"
                                      />
                                  </Link>
                </div><h2 class="-ml-2 text-white">Technology</h2>
                <div class="hidden lg:ml-10 lg:block">
                  <div class="flex space-x-4">
                    <a v-for="item in navigation" :key="item.name" :href="item.href" :class="[item.current ? 'bg-gray-700 text-white' : 'text-white hover:bg-gray-700', 'rounded-md px-3 py-2 text-sm font-medium']" :aria-current="item.current ? 'page' : undefined">{{ item.name }}</a>
                  </div>
                </div>
              </div>
              <div class="flex flex-1 justify-center px-2 lg:ml-6 lg:justify-end">
                <div class="grid w-full max-w-lg grid-cols-1 lg:max-w-xs">
                  <input type="search" name="search" aria-label="Search" class="col-start-1 row-start-1 block w-full rounded-md bg-gray-700 py-1.5 pl-10 pr-3 text-base text-gray-900 outline-none placeholder:text-gray-400 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-white/40 sm:text-sm/6" placeholder="Search" />
                  <MagnifyingGlassIcon class="pointer-events-none col-start-1 row-start-1 ml-3 size-5 self-center text-gray-700" aria-hidden="true" />
                </div>
              </div>
              <div class="flex lg:hidden">
                <!-- Mobile menu button -->
                <DisclosureButton class="relative inline-flex items-center justify-center rounded-md bg-gray-700 p-2 text-indigo-200 hover:bg-accent-500/75 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-indigo-600">
                  <span class="absolute -inset-0.5" />
                  <span class="sr-only">Open main menu</span>
                  <Bars3Icon v-if="!open" class="block size-6" aria-hidden="true" />
                  <XMarkIcon v-else class="block size-6" aria-hidden="true" />
                </DisclosureButton>
              </div>
              <div class="hidden lg:ml-4 lg:block">
                <div class="flex items-center">
                  <button type="button" class="relative shrink-0 rounded-full bg-gray-700 p-1 text-indigo-200 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-indigo-600">
                    <span class="absolute -inset-1.5" />
                    <span class="sr-only">View notifications</span>
                    <BellIcon class="size-6" aria-hidden="true" />
                  </button>
  
                  <!-- Profile dropdown -->
                  <div class="hidden sm:ms-6 sm:flex sm:items-center">
                              <!-- Settings Dropdown -->
                              <div class="relative ms-3">
                                  <Dropdown align="right" width="48">
                                      <template #trigger>
                                          <span class="inline-flex rounded-md">
                                              <button
                                                  type="button"
                                                  class="inline-flex items-center rounded-md border border-transparent bg-button px-3 py-2 text-sm font-medium leading-4 text-white transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                                              >
                                                  {{ $page.props.auth.user.name }}
  
                                                  <svg
                                                      class="-me-0.5 ms-2 h-4 w-4"
                                                      xmlns="http://www.w3.org/2000/svg"
                                                      viewBox="0 0 20 20"
                                                      fill="currentColor"
                                                  >
                                                      <path
                                                          fill-rule="evenodd"
                                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                          clip-rule="evenodd"
                                                      />
                                                  </svg>
                                              </button>
                                          </span>
                                      </template>
  
                                      <template #content>
                                          <DropdownLink
                                              :href="route('profile.edit')"
                                          >
                                              Settings
                                          </DropdownLink>
                                          <DropdownLink
                                              :href="route('logout')"
                                              method="post"
                                              as="button"
                                          >
                                              Log Out
                                          </DropdownLink>
                                      </template>
                                  </Dropdown>
                              </div>
                          </div>
              </div></div>
          <DisclosurePanel class="lg:hidden">
            <div class="space-y-1 px-2 pb-3 pt-2">
              <DisclosureButton v-for="item in navigation" :key="item.name" as="a" :href="item.href" :class="[item.current ? 'bg-gray-700 text-white' : 'text-white hover:bg-indigo-500/75', 'block rounded-md px-3 py-2 text-base font-medium']" :aria-current="item.current ? 'page' : undefined">{{ item.name }}</DisclosureButton>
            </div>
            <div class="border-t border-accent pb-3 pt-4">
              <div class="flex items-center px-5">
                <div class="shrink-0">
                </div>
                <div class="ml-3">
                  <div class="text-base font-medium text-white">{{ $page.props.auth.user.name }}</div>
                  <div class="text-sm font-medium text-indigo">{{ $page.props.auth.user.email }}</div>
                </div>
                <button type="button" class="relative ml-auto shrink-0 rounded-full bg-gray-700 p-1 text-indigo-200 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-accent">
                  <span class="absolute -inset-1.5" />
                  <span class="sr-only">View notifications</span>
                  <BellIcon class="size-6" aria-hidden="true" />
                </button>
              </div>
              <div class="mt-3 space-y-1 px-2">
                <DisclosureButton v-for="item in userNavigation" :key="item.name" as="a" :href="item.href" class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-indigo-500/75">{{ item.name }}</DisclosureButton>
              </div>
            </div>
          </DisclosurePanel>
            </div></div>
        </Disclosure>
        <header class="py-10">
          <alert class="alert" v-if="$page.props.flash.message">{{ $page.props.flash.message }}<button @click="closeFlashMessage" class="absolute top-0 right-0 mt-2 mr-2 text-black hover:text-gray-700">
              <XMarkIcon class="size-6" aria-hidden="true" />
            </button></alert>
          <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-accent">Service Dashboard</h1>
            <CurrentTime class="text-white"></CurrentTime>
          </div>
        </header>
      </div>
  
      <main class="-mt-32">
        
        <div class="mx-auto max-w-7xl px-4 pb-12 sm:px-6 lg:px-8">
          <div class="rounded-lg bg-gray-800 px-5 py-6 shadow sm:px-6">
            
            <!-- startcalendar -->
            <div>
    <h4 class="text-base font-semibold text-white">Upcoming meetings</h4>
    <div class="lg:grid lg:grid-cols-12 lg:gap-x-16">
      <div class="mt-10 text-center lg:col-start-8 lg:col-end-13 lg:row-start-1 lg:mt-9 xl:col-start-9">
        <div class="flex items-center text-accent">
          <button type="button" class="-m-1.5 flex flex-none items-center justify-center p-1.5 text-gray-400 hover:text-gray-500">
            <span class="sr-only">Previous month</span>
            <ChevronLeftIcon class="size-5" aria-hidden="true" />
          </button>
          <div class="flex-auto text-3xl font-semibold">January</div>
          <button type="button" class="-m-1.5 flex flex-none items-center justify-center p-1.5 text-gray-400 hover:text-gray-500">
            <span class="sr-only">Next month</span>
            <ChevronRightIcon class="size-5" aria-hidden="true" />
          </button>
        </div>
        <div class="mt-6 grid grid-cols-7 text-lg/6 text-accent">
          <div class="text-success">M</div>
          <div class="text-success">T</div>
          <div class="text-success">W</div>
          <div class="text-success">T</div>
          <div class="text-success">F</div>
          <div class="text-white">$</div>
          <div class="text-white">$</div>
        </div>
        <div class="isolate mt-2 grid grid-cols-7 gap-px rounded-lg bg-gray-200 text-sm shadow ring-1 ring-gray-200">
          <button v-for="(day, dayIdx) in days" :key="day.date" type="button" :class="['py-1.5 hover:bg-gray-100 focus:z-10', day.isCurrentMonth ? 'bg-gray-400' : 'bg-gray-500', (day.isSelected || day.isToday) && 'font-semibold', day.isSelected && 'text-white', !day.isSelected && day.isCurrentMonth && !day.isToday && 'text-gray-900', !day.isSelected && !day.isCurrentMonth && !day.isToday && 'text-gray-400', day.isToday && !day.isSelected && 'text-indigo-600', dayIdx === 0 && 'rounded-tl-lg', dayIdx === 6 && 'rounded-tr-lg', dayIdx === days.length - 7 && 'rounded-bl-lg', dayIdx === days.length - 1 && 'rounded-br-lg']">
            <time :datetime="day.date" :class="['mx-auto flex size-7 items-center justify-center rounded-full', day.isSelected && day.isToday && 'bg-main', day.isSelected && !day.isToday && 'bg-accent']">{{ day.date.split('-').pop().replace(/^0/, '') }}</time>
          </button>
        </div>
        
        <!-- MODAL -->
        <button @click="addWorkOrder" class="btn btn-lg btn-success mt-8 text-white text-2xl shadow hover:bg-success focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add Work Order</button>
        
        <div v-for="(workOrder, index) in workOrders" :key="index">
          <Modal :show="workOrder.showModal" @close="closeModal(index)" :workOrder="workOrder"></Modal>
        </div>
      </div>

      <!-- Modal ends -->
      <ol class="mt-4 divide-y divide-gray-100 text-sm/6 lg:col-span-7 xl:col-span-8">
        <li v-for="meeting in meetings" :key="meeting.id" class="relative flex gap-x-6 py-6 xl:static">
          <img :src="meeting.imageUrl" alt="" class="size-14 flex-none rounded-full" />
          <div class="flex-auto">
            <h3 class="pr-10 font-semibold text-accent xl:pr-0">{{ meeting.name }}</h3>
            <dl class="mt-2 flex flex-col text-gray-500 xl:flex-row">
              <div class="flex items-start gap-x-3">
                <dt class="mt-0.5">
                  <span class="sr-only">Date</span>
                  <CalendarIcon class="size-5 text-gray-400" aria-hidden="true" />
                </dt>
                <dd>
                  <time :datetime="meeting.datetime">{{ meeting.date }} at {{ meeting.time }}</time>
                </dd>
              </div>
              <div class="mt-2 flex items-start gap-x-3 xl:ml-3.5 xl:mt-0 xl:border-l xl:border-gray-400/50 xl:pl-3.5">
                <dt class="mt-0.5">
                  <span class="sr-only">Location</span>
                  <MapPinIcon class="size-5 text-gray-400" aria-hidden="true" />
                </dt>
                <dd>{{ meeting.location }}</dd>
              </div>
            </dl>
          </div>
          <Menu as="div" class="absolute right-0 top-6 xl:relative xl:right-auto xl:top-auto xl:self-center">
            <div>
              <MenuButton class="-m-2 flex items-center rounded-full p-2 text-gray-500 hover:text-gray-600">
                <span class="sr-only">Open options</span>
                <EllipsisHorizontalIcon class="size-5" aria-hidden="true" />
              </MenuButton>
            </div>

            <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
              <MenuItems class="absolute right-0 z-10 mt-2 w-36 origin-top-right rounded-md bg-gray-700 shadow-lg ring-1 ring-black/5 focus:outline-none">
                <div class="py-1">
                  <MenuItem v-slot="{ active }">
                    <a href="#" :class="[active ? 'bg-gray-600 text-white outline-none' : 'text-white', 'block px-4 py-2 text-sm']">Edit</a>
                  </MenuItem>
                  <MenuItem v-slot="{ active }">
                    <a href="#" :class="[active ? 'bg-gray-600 text-white outline-none' : 'text-white', 'block px-4 py-2 text-sm']">Cancel</a>
                  </MenuItem>
                </div>
              </MenuItems>
            </transition>
          </Menu>
        </li>
      </ol>
    </div>
  </div>
<!-- end calendar -->
          </div>
        </div>
      </main>
    </div>
  </template>
  
<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import CurrentTime from '@/Components/CurrentTime.vue';
import { Link } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import alert from '@/Components/alert.vue';

const showModal = ref(false);
const closeModal = (index) => {
  workOrders.value[index].showModal = false;
};
const showingNavigationDropdown = ref(false);
const closeFlashMessage = () => {
  flashMessageVisible.value = false;
};
  
import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { MagnifyingGlassIcon } from '@heroicons/vue/20/solid'
import { Bars3Icon, BellIcon, XMarkIcon } from '@heroicons/vue/24/outline'
import { CalendarIcon, ChevronLeftIcon, ChevronRightIcon, EllipsisHorizontalIcon, MapPinIcon} from '@heroicons/vue/20/solid'
import Alert from '@/Components/alert.vue';
  
const user = {
  name: 'props.auth.user.name',
  email: 'props.auth.user.email',
  imageUrl:
    'https://www.nmtechnology.us/build/assets/nm-logo-rmbg-f8bd446d.webp',
  }
  
const navigation = [
    { name: 'Dashboard', href: '/dashboard', current: true },
    { name: 'Team', href: '#', current: false },
    { name: 'Work Orders', href: '#', current: false },
    { name: 'Calendar', href: '#', current: false },
    { name: 'Reports', href: '#', current: false },
  ]
  const userNavigation = [
    { name: 'Your Profile', href: 'profile.edit' },
    { name: 'Settings', href: '#' },
    { name: 'Sign out', href: '#' },
  ]
  const meetings = [
  {
    id: 1,
    date: 'January 10th, 2022',
    time: '5:00 PM',
    datetime: '2022-01-10T17:00',
    name: 'Leslie Alexander',
    imageUrl:
      'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
    location: 'Starbucks',
  },
  // More meetings...
]
const days = [
  { date: '2021-12-27' },
  { date: '2021-12-28' },
  { date: '2021-12-29' },
  { date: '2021-12-30' },
  { date: '2021-12-31' },
  { date: '2022-01-01', isCurrentMonth: true },
  { date: '2022-01-02', isCurrentMonth: true },
  { date: '2022-01-03', isCurrentMonth: true },
  { date: '2022-01-04', isCurrentMonth: true },
  { date: '2022-01-05', isCurrentMonth: true },
  { date: '2022-01-06', isCurrentMonth: true },
  { date: '2022-01-07', isCurrentMonth: true },
  { date: '2022-01-08', isCurrentMonth: true },
  { date: '2022-01-09', isCurrentMonth: true },
  { date: '2022-01-10', isCurrentMonth: true },
  { date: '2022-01-11', isCurrentMonth: true },
  { date: '2022-01-12', isCurrentMonth: true, isToday: true },
  { date: '2022-01-13', isCurrentMonth: true },
  { date: '2022-01-14', isCurrentMonth: true },
  { date: '2022-01-15', isCurrentMonth: true },
  { date: '2022-01-16', isCurrentMonth: true },
  { date: '2022-01-17', isCurrentMonth: true },
  { date: '2022-01-18', isCurrentMonth: true },
  { date: '2022-01-19', isCurrentMonth: true },
  { date: '2022-01-20', isCurrentMonth: true },
  { date: '2022-01-21', isCurrentMonth: true },
  { date: '2022-01-22', isCurrentMonth: true, isSelected: true },
  { date: '2022-01-23', isCurrentMonth: true },
  { date: '2022-01-24', isCurrentMonth: true },
  { date: '2022-01-25', isCurrentMonth: true },
  { date: '2022-01-26', isCurrentMonth: true },
  { date: '2022-01-27', isCurrentMonth: true },
  { date: '2022-01-28', isCurrentMonth: true },
  { date: '2022-01-29', isCurrentMonth: true },
  { date: '2022-01-30', isCurrentMonth: true },
  { date: '2022-01-31', isCurrentMonth: true },
  { date: '2022-02-01' },
  { date: '2022-02-02' },
  { date: '2022-02-03' },
  { date: '2022-02-04' },
  { date: '2022-02-05' },
  { date: '2022-02-06' },
]
const workOrders = ref([]);

const addWorkOrder = () => {
  workOrders.value.push({
    id: Date.now(), // Unique ID for each work order
    title: '',
    description: '',
    scheduled_at: '',
    images: [],
    notes: '',
    showModal: true,
  });
};
  </script>
  
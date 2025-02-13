<template>
  <Head title="Dashboard" />
  <div class="min-h-full">
    <div class="bg-base-400">
      <Disclosure as="nav" class="border-b bg-transparent lg:border-none" v-slot="{ open }">
        <div class="mx-auto max-w-7xl px-2 sm:px-4 lg:px-8">
          <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
                <div class="relative z-auto left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem]  rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 20.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" />
            </div>
          <div class="relative flex h-16 items-center justify-between lg:border-b lg:border-accent">
            <div class="flex items-center px-2 lg:px-0">
              <div class="shrink-0">
                <Link :href="route('dashboard')">
                  <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800" />
                </Link>
              </div>
              <h2 class="-ml-3 font-extrabold text-white italic">Technology</h2>
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
                          <button type="button" class="inline-flex items-center rounded-md border border-transparent bg-button px-3 py-2 text-sm font-medium leading-4 text-white transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none">
                            {{ $page.props.auth.user.name }}
                            <svg class="-me-0.5 ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                          </button>
                        </span>
                      </template>
                      <template #content>
                        <DropdownLink :href="route('profile.edit')">Settings</DropdownLink>
                        <DropdownLink :href="route('logout')" method="post" as="button">Log Out</DropdownLink>
                      </template>
                    </Dropdown>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <DisclosurePanel class="lg:hidden">
            <div class="space-y-1 px-2 pb-3 pt-2">
              <DisclosureButton v-for="item in navigation" :key="item.name" as="a" :href="item.href" :class="[item.current ? 'bg-gray-700 text-white' : 'text-white hover:bg-indigo-500/75', 'block rounded-md px-3 py-2 text-base font-medium']" :aria-current="item.current ? 'page' : undefined">{{ item.name }}</DisclosureButton>
            </div>
            <div class="border-t border-accent pb-3 pt-4">
              <div class="flex items-center px-5">
                <div class="shrink-0"></div>
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
              <div>
                <DisclosureButton v-for="item in userNavigation" :key="item.name" as="a" :href="item.href" class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-indigo-500/75">{{ item.name }}</DisclosureButton>
              </div>
            </div>
          </DisclosurePanel>
        </div>
      </Disclosure>
      <header class="">
        <!-- <alert class="alert" v-if="$page.props.flash.message">{{ $page.props.flash.message }}<button @click="closeFlashMessage" class="absolute top-0 right-0 mt-2 mr-2 text-black hover:text-gray-700">
          <XMarkIcon class="size-6" aria-hidden="true" />
        </button></alert> --><div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[46.125rem] -translate-x-1/2 rotate-[45deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 20.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" />
            </div>
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
          <h1 class="text-3xl font-bold tracking-tight text-accent">Service Dashboard</h1>
          <CurrentTime class="text-white"></CurrentTime>
        </div>
      </header>
    </div>
    <main class="mt-10">
      <div class="mx-auto max-w-7xl px-4 pb-12 sm:px-6 lg:px-8">
        <div class="rounded-lg bg-gray-900-transparent px-2 py-6 shadow sm:px-6">
          
          <div class="grid grid-cols-1 lg:grid-cols-7 gap-6">
            <div class="lg:col-span-7">
              <div class="lg:col-span-5">
              
              <!-- MODAL -->
              <AddWorkorder />
              <!-- Modal ends -->
            </div>
              <!-- start calendar -->
              <div class="mt-10 text-center lg:col-start-8 lg:col-end-13 lg:row-start-1 lg:mt-9 xl:col-start-9">
                
                <Calendar :workOrders="workOrders" /><Index class="mt-40" />
            </div>
          </div>
        </div>
      </div></div>
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
import alert from '@/Components/alert.vue';
import { Head, usePage } from '@inertiajs/vue3';
import AddWorkorder from '@/Components/AddWorkorder.vue';
import Index from './WorkOrders/Index.vue';
import Calendar from '@/Components/Calendar.vue';
import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { MagnifyingGlassIcon } from '@heroicons/vue/20/solid'
import { Bars3Icon, BellIcon, XMarkIcon } from '@heroicons/vue/24/outline'

const flashMessageVisible = ref(true);
const closeFlashMessage = () => {
  flashMessageVisible.value = false;
};
const { props } = usePage();
const workOrders = ref(props.workOrders || []);


const user = {
  name: 'props.auth.user.name',
  email: 'props.auth.user.email',
  imageUrl:
    'https://www.nmtechnology.us/build/assets/nm-logo-rmbg-f8bd446d.webp',
  }
  
const navigation = [
    { name: 'Dashboard', href: route('dashboard'), current: true },
    { name: 'Team', href: '#', current: false },
    { name: 'Work Orders', href: route('work-orders.index'), current: false },
    { name: 'Calendar', href: '#', current: false },
    { name: 'Reports', href: '#', current: false },
  ]
  const userNavigation = [
    { name: 'Your Profile', href: 'profile.edit' },
    { name: 'Settings', href: '#' },
    { name: 'Sign out', href: '#' },
  ]
  

  </script>
  
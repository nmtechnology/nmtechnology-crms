<template>
    <div class="rounded-md bg-green-50 p-4 min-h-full">
      <div class="flex">
        <div class="shrink-0">
          <CheckCircleIcon class="size-8 text-green-400" aria-hidden="true" />
        </div>
        <div class="ml-3">
          <p class="text-sm font-medium text-green-800">{{ $page.props.flash.message }}</p>
        </div>
        <div class="ml-auto pl-3">
          <div class="-mx-1.5 -my-1.5">
            <button @click="closeFlashMessage" type="button" class="inline-flex rounded-md bg-green-50 p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">
              <span class="sr-only">Dismiss</span>
              <XMarkIcon class="size-5" aria-hidden="true" />
            </button>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { CheckCircleIcon, XMarkIcon } from '@heroicons/vue/20/solid'

  const closeFlashMessage = () => {
  flashMessageVisible.value = false;
};
  </script>
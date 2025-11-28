<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
  shop_name: '',
  shop_description: '',
  pic_name: '',
  pic_phone: '',
  pic_email: '',
  pic_address: '',
  rt: '',
  rw: '',
  kelurahan: '',
  kota: '',
  provinsi: '',
  pic_id_number: '',
  pic_id_photo: null,
  pic_photo: null,
});

const submit = () => {
  form.post(route('seller.register.store'), {
    forceFormData: true,
  });
};
</script>

<template>
  <GuestLayout>
    <h1 class="text-xl font-bold mb-4">Registrasi Penjual</h1>

    <form @submit.prevent="submit" enctype="multipart/form-data" class="space-y-4">
      <div>
        <label class="block text-sm font-medium">Nama Toko</label>
        <input
          v-model="form.shop_name"
          class="mt-1 block w-full border rounded px-2 py-1"
        />
        <div v-if="form.errors.shop_name" class="text-red-600 text-sm">
          {{ form.errors.shop_name }}
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium">Deskripsi Toko</label>
        <input
          v-model="form.shop_description"
          class="mt-1 block w-full border rounded px-2 py-1"
        />
        <div v-if="form.errors.shop_description" class="text-red-600 text-sm">
          {{ form.errors.shop_description }}
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium">Nama PIC</label>
        <input
          v-model="form.pic_name"
          class="mt-1 block w-full border rounded px-2 py-1"
        />
        <div v-if="form.errors.pic_name" class="text-red-600 text-sm">
          {{ form.errors.pic_name }}
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium">Nomor Telepon PIC</label>
        <input
          v-model="form.pic_phone"
          class="mt-1 block w-full border rounded px-2 py-1"
        />
        <div v-if="form.errors.pic_phone" class="text-red-600 text-sm">
          {{ form.errors.pic_phone }}
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium">Email PIC</label>
        <input
          type="email"
          v-model="form.pic_email"
          class="mt-1 block w-full border rounded px-2 py-1"
        />
        <div v-if="form.errors.pic_email" class="text-red-600 text-sm">
          {{ form.errors.pic_email }}
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium">Alamat PIC</label>
        <input
          v-model="form.pic_address"
          class="mt-1 block w-full border rounded px-2 py-1"
        />
        <div v-if="form.errors.pic_address" class="text-red-600 text-sm">
          {{ form.errors.pic_address }}
        </div>
      </div>

      <div class="grid grid-cols-2 gap-2">
        <div>
          <label class="block text-sm font-medium">RT</label>
          <input
            v-model="form.rt"
            class="mt-1 block w-full border rounded px-2 py-1"
          />
          <div v-if="form.errors.rt" class="text-red-600 text-sm">
            {{ form.errors.rt }}
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium">RW</label>
          <input
            v-model="form.rw"
            class="mt-1 block w-full border rounded px-2 py-1"
          />
          <div v-if="form.errors.rw" class="text-red-600 text-sm">
            {{ form.errors.rw }}
          </div>
        </div>
        
      </div>
      <div class="grid grid-cols-2 gap-2">
        <div>
          <label class="block text-sm font-medium">Kelurahan</label>
          <input
            v-model="form.kelurahan"
            class="mt-1 block w-full border rounded px-2 py-1"
          />
          <div v-if="form.errors.kelurahan" class="text-red-600 text-sm">
            {{ form.errors.kelurahan }}
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium">Kecamatan</label>
          <input
            v-model="form.kecamatan"
            class="mt-1 block w-full border rounded px-2 py-1"
          />
          <div v-if="form.errors.kecamatan" class="text-red-600 text-sm">
            {{ form.errors.kecamatan }}
          </div>
        </div>
      </div>

      <div class="grid grid-cols-2 gap-2">
        <div>
          <label class="block text-sm font-medium">Kota</label>
          <input
            v-model="form.kota"
            class="mt-1 block w-full border rounded px-2 py-1"
          />
          <div v-if="form.errors.kota" class="text-red-600 text-sm">
            {{ form.errors.kota }}
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium">Provinsi</label>
          <input
            v-model="form.provinsi"
            class="mt-1 block w-full border rounded px-2 py-1"
          />
          <div v-if="form.errors.provinsi" class="text-red-600 text-sm">
            {{ form.errors.provinsi }}
          </div>
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium">Nomor ID PIC</label>
        <input
          v-model="form.pic_id_number"
          class="mt-1 block w-full border rounded px-2 py-1"
        />
        <div v-if="form.errors.pic_id_number" class="text-red-600 text-sm">
          {{ form.errors.pic_id_number }}
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium">Foto KTP PIC</label>
        <input
          type="file"
          class="mt-1 block w-full"
          @change="e => form.pic_id_photo = e.target.files[0]"
        />
        <div v-if="form.errors.pic_id_photo" class="text-red-600 text-sm">
          {{ form.errors.pic_id_photo }}
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium">Foto PIC</label>
        <input
          type="file"
          class="mt-1 block w-full"
          @change="e => form.pic_photo = e.target.files[0]"
        />
        <div v-if="form.errors.pic_photo" class="text-red-600 text-sm">
          {{ form.errors.pic_photo }}
        </div>
      </div>

      <button
        type="submit"
        :disabled="form.processing"
        class="px-4 py-2 bg-indigo-600 text-white rounded disabled:opacity-50"
      >
        Kirim Registrasi
      </button>
    </form>
  </GuestLayout>
</template>

import GuestLayout from '@/Layouts/GuestLayout.jsx';
import { useForm } from '@inertiajs/react';
import InputLabel from '@/Components/InputLabel.jsx';
import TextInput from '@/Components/TextInput.jsx';
import InputError from '@/Components/InputError.jsx';
import PrimaryButton from '@/Components/PrimaryButton.jsx';

export default function RegisterSeller() {
    const { data, setData, post, processing, errors } = useForm({
        shop_name: '',
        shop_description: '',
        pic_name: '',
        pic_phone: '',
        pic_email: '',
        pic_address: '',
        rt: '',
        rw: '',
        kelurahan: '',
        kecamatan: '',
        kota: '',
        provinsi: '',
        pic_id_number: '',
        pic_id_photo: null,
        pic_photo: null,
    });

    function submit(e) {
        e.preventDefault();
        post(route('seller.register.store'), {
            forceFormData: true, // untuk upload file
        });
    }

    return (
        <GuestLayout>
            <h1>Registrasi Penjual</h1>

            <form onSubmit={submit} encType="multipart/form-data" className="space-y-4">
                <div>
                    <InputLabel htmlFor="shop_name" value="Nama Toko" />
                    <TextInput
                        id="shop_name"
                        value={data.shop_name}
                        onChange={e => setData('shop_name', e.target.value)}
                        className="mt-1 block w-full"
                    />
                    <InputError message={errors.shop_name} className="mt-2" />
                </div>
                <div>
                    <InputLabel htmlFor="shop_description" value="Deskripsi Toko" />
                    <TextInput
                        id="shop_description"
                        value={data.shop_description}
                        onChange={e => setData('shop_description', e.target.value)}
                        className="mt-1 block w-full"
                    />
                    <InputError message={errors.shop_description} className="mt-2" />
                </div>
                <div>
                    <InputLabel htmlFor="pic_name" value="Nama PIC" />
                    <TextInput
                        id="pic_name"
                        value={data.pic_name}
                        onChange={e => setData('pic_name', e.target.value)}
                        className="mt-1 block w-full"
                    />
                    <InputError message={errors.pic_name} className="mt-2" />
                </div>
                <div>
                    <InputLabel htmlFor="pic_phone" value="Nomor Telepon PIC" />
                    <TextInput
                        id="pic_phone"
                        value={data.pic_phone}
                        onChange={e => setData('pic_phone', e.target.value)}
                        className="mt-1 block w-full"
                    />
                    <InputError message={errors.pic_phone} className="mt-2" />
                </div>
                <div>
                    <InputLabel htmlFor="pic_email" value="Email PIC" />
                    <TextInput
                        id="pic_email"
                        type="email"
                        value={data.pic_email}
                        onChange={e => setData('pic_email', e.target.value)}
                        className="mt-1 block w-full"
                    />
                    <InputError message={errors.pic_email} className="mt-2" />
                </div>
                <div>
                    <InputLabel htmlFor="pic_address" value="Alamat PIC" />
                    <TextInput
                        id="pic_address"
                        value={data.pic_address}
                        onChange={e => setData('pic_address', e.target.value)}
                        className="mt-1 block w-full"
                    />
                    <InputError message={errors.pic_address} className="mt-2" />
                </div>
                <div>
                    <InputLabel htmlFor="rt" value="RT" />
                    <TextInput
                        id="rt"
                        value={data.rt}
                        onChange={e => setData('rt', e.target.value)}
                        className="mt-1 block w-full"
                    />
                    <InputError message={errors.rt} className="mt-2" />
                </div>
                <div>
                    <InputLabel htmlFor="rw" value="RW" />
                    <TextInput
                        id="rw"
                        value={data.rw}
                        onChange={e => setData('rw', e.target.value)}
                        className="mt-1 block w-full"
                    />
                    <InputError message={errors.rw} className="mt-2" />
                </div>
                <div>
                    <InputLabel htmlFor="kelurahan" value="Kelurahan" />
                    <TextInput
                        id="kelurahan"
                        value={data.kelurahan}
                        onChange={e => setData('kelurahan', e.target.value)}
                        className="mt-1 block w-full"
                    />
                    <InputError message={errors.kelurahan} className="mt-2" />
                </div>
                <div>
                    <InputLabel htmlFor="kecamatan" value="Kecamatan" />
                    <TextInput
                        id="kecamatan"
                        value={data.kecamatan}
                        onChange={e => setData('kecamatan', e.target.value)}
                        className="mt-1 block w-full"
                    />
                    <InputError message={errors.kelurahan} className="mt-2" />
                </div>
                <div>
                    <InputLabel htmlFor="kota" value="Kota" />
                    <TextInput
                        id="kota"
                        value={data.kota}
                        onChange={e => setData('kota', e.target.value)}
                        className="mt-1 block w-full"
                    />
                    <InputError message={errors.kota} className="mt-2" />
                </div>
                <div>
                    <InputLabel htmlFor="provinsi" value="Provinsi" />
                    <TextInput
                        id="provinsi"
                        value={data.provinsi}
                        onChange={e => setData('provinsi', e.target.value)}
                        className="mt-1 block w-full"
                    />
                    <InputError message={errors.provinsi} className="mt-2" />
                </div>
                <div>
                    <InputLabel htmlFor="pic_id_number" value="Nomor ID PIC" />
                    <TextInput
                        id="pic_id_number"
                        value={data.pic_id_number}
                        onChange={e => setData('pic_id_number', e.target.value)}
                        className="mt-1 block w-full"
                    />
                    <InputError message={errors.pic_id_number} className="mt-2" />
                </div>
                <div>
                    <InputLabel htmlFor="pic_id_photo" value="Foto KTP PIC" />
                    <input
                        id="pic_id_photo"
                        type="file"
                        onChange={e => setData('pic_id_photo', e.target.files[0])}
                        className="mt-1 block w-full"
                    />
                    {errors.pic_id_photo && <div>{errors.pic_id_photo}</div>}
                </div>
                <div>
                    <InputLabel htmlFor="pic_photo" value="Foto PIC" />
                    <input
                        id="pic_photo"
                        type="file"
                        onChange={e => setData('pic_photo', e.target.files[0])}
                        className="mt-1 block w-full"
                    />
                    {errors.pic_photo && <div>{errors.pic_photo}</div>}
                </div>

                <PrimaryButton disabled={processing} className="mt-4">
                    Kirim Registrasi
                </PrimaryButton>
            </form>
        </GuestLayout>
    );
}

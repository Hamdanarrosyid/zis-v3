const tingkatBaca = document.querySelector('#tingkat_baca_selector')
const pencapaian = document.querySelector('#pencapaian_baca')
const select = async () => {
    let option = tingkatBaca.options[tingkatBaca.selectedIndex].value

    await fetch('/santri/show')
        .then(res => res.json())
        .then(r => {
            const juz = r.juz
            const iqro = r.iqro

            if (option === 'Al-Quran') {
                pencapaian.setAttribute('name','juz_id')
                let html = juz.map(data => {
                        return `<option value="${data.id}">Juz ${data.juz}</option>`
                })
                pencapaian.innerHTML = html
            }
            if (option === 'Iqro') {
                pencapaian.setAttribute('name','iqro_id')
                let html = iqro.map(data => {
                    return `<option value="${data.id}">Jilid ${data.jilid}</option>`
                })
                pencapaian.innerHTML = html
            }
        })
}


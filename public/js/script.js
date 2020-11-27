const tingkatBaca = document.querySelector('#tingkat_baca_selector')
const pencapaian = document.querySelector('#pencapaian_baca')
const select = async () => {
    let option = tingkatBaca.options[tingkatBaca.selectedIndex].value

    await fetch('/santri/show')
        .then(res => res.json())
        .then(r => {
            const datas = r.pencapaian
            console.log(datas)
            const filter = datas.filter(data => {
                return data.tingkatbaca_id == option
            })
            let html = filter.map(dataFilter =>{
                return `<option value="${dataFilter.id}">${dataFilter.nomor_pencapaian}</option>`
            })
            pencapaian.innerHTML = html
        })
}


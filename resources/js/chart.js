// Dashboard Page
// Simulasi data
const data = {
    totalBarang: 1250,
    barangMasuk: 145,
    barangKeluar: 98,
    totalNilai: 275000000,
};

// Update nilai statistik
document.getElementById("totalBarang").textContent =
    data.totalBarang.toLocaleString();
document.getElementById("barangMasuk").textContent =
    data.barangMasuk.toLocaleString();
document.getElementById("barangKeluar").textContent =
    data.barangKeluar.toLocaleString();
document.getElementById("totalNilai").textContent =
    "Rp " + data.totalNilai.toLocaleString();

// Data untuk Line Chart
const trenChart = new Chart(document.getElementById("trenChart"), {
    type: "line",
    data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun"],
        datasets: [
            {
                label: "Total Barang",
                data: [1000, 1050, 1150, 1200, 1220, 1250],
                borderColor: "rgb(59, 130, 246)",
                tension: 0.4,
            },
        ],
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: "bottom",
            },
        },
    },
});

// Data untuk Bar Chart
const comparisonChart = new Chart(document.getElementById("comparisonChart"), {
    type: "bar",
    data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun"],
        datasets: [
            {
                label: "Barang Masuk",
                data: [120, 135, 140, 138, 142, 145],
                backgroundColor: "rgb(34, 197, 94)",
            },
            {
                label: "Barang Keluar",
                data: [85, 90, 88, 95, 92, 98],
                backgroundColor: "rgb(239, 68, 68)",
            },
        ],
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: "bottom",
            },
        },
        scales: {
            y: {
                beginAtZero: true,
            },
        },
    },
});

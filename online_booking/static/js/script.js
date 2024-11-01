const datePicker = document.getElementById("date-picker");
const timeSlotGrid = document.getElementById("time-slot-grid");
const weekdaysContainer = document.querySelector(".weekdays");
const timeSlotHeader = document.querySelector(".time-slot-header");
const timeSlotArr = Array.from({ length: 24 * 2 }, (_, i) =>
	`${String(Math.floor(i / 2)).padStart(2, "0")}:${i % 2 === 0 ? "00" : "30"}`
);

let selectedSlots = [];

datePicker.addEventListener("change", (e) => {
	const selectedDate = new Date(e.target.value);
	renderWeekdays(selectedDate);
	renderTimeSlots(selectedDate);
});

function renderWeekdays(startDate) {
	// Calculate the previous Sunday or desired start of the week based on the selected date
	const weekStartDate = new Date(startDate);
	weekStartDate.setDate(startDate.getDate() - startDate.getDay()); // Adjusts to Sunday of the week

	weekdaysContainer.innerHTML = ""; // Clear previous weekdays
	const timeLabel = document.createElement("div");
	timeLabel.innerText = "Time";
	timeLabel.className = 'time-label';
	weekdaysContainer.appendChild(timeLabel);
	// Populate each day for the week
	for (let i = 0; i < 7; i++) {
		const day = new Date(weekStartDate);
		day.setDate(day.getDate() + i); // Move forward one day at a time

		const dayBox = document.createElement("div");
		dayBox.innerHTML = `${day.toLocaleDateString("en-US", {
			weekday: "short",
		})}<br>${day.getDate()}/${day.getMonth() + 1}`;

		weekdaysContainer.appendChild(dayBox);
	}
}

function renderTimeSlots(startDate) {
	timeSlotGrid.innerHTML = "";
	timeSlotArr.forEach((time) => {
		const timeLabel = document.createElement("div");
		timeLabel.innerText = time;
		timeSlotGrid.appendChild(timeLabel);

		for (let i = 0; i < 7; i++) {
			const day = new Date(startDate);
			day.setDate(day.getDate() + i - startDate.getDay());

			// Check if the slot is available (example: assume all slots are available)
			const isAvailable = true; // Replace with your logic for booked vs. available

			const timeSlotCell = document.createElement("div");
			timeSlotCell.className = isAvailable ? "available" : "booked";
			timeSlotCell.dataset.date = `${day.getFullYear()}-${String(
				day.getMonth() + 1
			).padStart(2, "0")}-${String(day.getDate()).padStart(2, "0")}`;
			timeSlotCell.dataset.time = time;

			if (isAvailable) {
				timeSlotCell.addEventListener("click", () => toggleSlotSelection(timeSlotCell));
			}

			timeSlotGrid.appendChild(timeSlotCell);
		}
	});
}


function toggleSlotSelection(cell) {
	if (cell.classList.contains("booked")) return;

	const date = cell.dataset.date;
	const time = cell.dataset.time;
	const slotId = `${date} ${time}`;

	if (selectedSlots.includes(slotId)) {
		selectedSlots = selectedSlots.filter((slot) => slot !== slotId);
		cell.classList.remove("selected");
	} else {
		selectedSlots.push(slotId);
		cell.classList.add("selected");
	}

	const result = checkContinuousTimeSlots(selectedSlots);
	console.log('result', result)
	if (typeof result === "string") {
		console.log(result); // Outputs if slots are not continuous
	} else {
		console.log("Start:", result.start);
		console.log("End:", result.end);
	}
}

function checkContinuousTimeSlots(selectedSlots) {
	if (selectedSlots.length === 0) {
		return "No time slots selected.";
	}

	// Parse selected slots into Date objects
	const parsedSlots = selectedSlots.map((slot) => {
		const [date, time] = slot.split(" ");
		return new Date(`${date}T${time}`);
	});

	// Sort the parsed slots
	parsedSlots.sort((a, b) => a - b);

	// Check if each slot is exactly 30 minutes after the previous one
	for (let i = 1; i < parsedSlots.length; i++) {
		const differenceInMinutes = (parsedSlots[i] - parsedSlots[i - 1]) / (1000 * 60);
		if (differenceInMinutes !== 30) {
			return "Selected slots are not continuous.";
		}
	}

	// If slots are continuous, return the start and end datetime
	const start = parsedSlots[0];
	const end = new Date(parsedSlots[parsedSlots.length - 1].getTime() + 30 * 60 * 1000); // Add 30 minutes to last slot

	return { start, end };
}


// Initial render with today's date
const today = new Date();
datePicker.value = today.toISOString().split("T")[0];
renderWeekdays(today);
renderTimeSlots(today);
console.log("12345")
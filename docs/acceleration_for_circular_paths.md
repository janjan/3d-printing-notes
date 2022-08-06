# Acceleration on circular paths

## Introduction

Due to the elastic nature of the molten filament in the hotend (and also the flexibility of the solid filament in the bowden tube in case of bowden-style extruders) there is always a slight delay until a requested change in the volumetric flow rate (aka "the volume of material extruded per second") actually takes place. 

This means that at the start of the print it takes a bit of time to build up enough internal pressure until the material is extruded from the nozzle. A similar thing happens at the end of the extrusion: even after stepper motor of the extruder stopped moving there is still a bit of molten filament ozzing out of the nozzle due to the built-up internal pressure. And similar things are also happening when the flow rate drastically changes in the middle of the print. 

Especially in sharp corners this non-instant response results in visible artifacts due to over/underextrusion. To remove these artifacts it would be necessary that the speed of the print head (and therefore the flow rate) stays constant throughout the print. Unfortunately due to the limited amount of acceleration in a real world printers this is not possible, especially when printing rectangular infill or tight corners in outer perimeters. Therefore modern printer firmwares use methods like [Pressure Advance](https://www.klipper3d.org/Pressure_Advance.html) to remove most of these artifacts.

Nevertheless it is interesting to figure out under which circumstances a print head is able to change its direction without loosing any speed. While a general answer is impossible to give, a simple formula for circular corners is derived below. With this information you should be able to guesstimate in which situations a printer might run into problems and how this can potentially be avoided by changing print settings or by redesigning the object.

## Math

To derive the math we use the following scenario:

![Volumetric flow rate in Prusaslicer](/src/images/circular-path.png)

First we must calculate the angular frequency $\omega$ of the print head for a circular movementwith the radius $r$ and the speed $v_n$. The generic definition of the angular frequency is

$$\omega = 2 \pi f = \frac{2\pi}{T}$$

where $T$ is the time it takes for the print head to make a full rotation. We can calculate this with the generic definition of speed $v = s / t$ and the formula for the circumference of the circle $s_c = 2 \pi r$:

$$T = s_c / v_n = \frac{2 \pi r}{v_n}$$

If we plug $T$ into $\omega$ we end up with

$$\omega = \frac{2\pi}{T} = \frac{2\pi}{\frac{2 \pi r}{v_n}} = \frac{v_n}{r}$$

The position of the nozzle for a given time $t$ is given by:

$$x(t) = r * \sin(\omega  t) = r * \sin(\frac{v_n}{r} t)$$

$$y(t) = r * \cos(\omega  t) = r * \sin(\frac{v_n}{r} t)$$

Since $x$ and $y$ are very similar we are just going to concentrate on $x$. Working on $y$ will give the same end result.

By deriving $x(t)$ to times we get the speed and the acceleration of the print head along the x axis

$$x(t) = r * \sin(\frac{v_n}{r} t)$$

$$\dot{x}(t) = v_x(t) = v_n * \cos(\frac{v_n}{r} t)$$

$$\ddot{x}(t) = a_x(t) = \frac{v_n^2}{r} * \sin(\frac{v_n}{r} t)$$

Since the value of $\cos(x)$ is between -1 and 1 we know that the maximum acceleration along one of the axes is

$$ a_{MAX} = \frac{v_n^2}{r}$$

This means that if you want to print a corner with a radius of $5\ mm$ and a speed of $80\ mm/s$ then printer must be capable of an acceleration of at least $1280\ mm/s^2$. Otherwise the print will be slowed down by the printer firmware and you might end up with artifacts.

## Numbers

| | r = 1 mm |  r = 2 mm |  r = 5 mm |  r = 10 mm |  r = 20 mm | 
|--- |--- | --- | --- | --- | --- | 
| **40 mm/s** | 🟨 1600 |🟩 800 |🟩 320 |🟩 160 |🟩 80 |
| **60 mm/s** | 🟧 3600 |🟨 1800 |🟩 720 |🟩 360 |🟩 180 |
| **80 mm/s** | 🟥 6400 |🟧 3200 |🟨 1280 |🟩 640 |🟩 320 |
| **100 mm/s** | 🟥 10000 |🟧 5000 |🟨 2000 |🟩 1000 |🟩 500 |
| **120 mm/s** | 🟪 14400 |🟥 7200 |🟧 2880 |🟨 1440 |🟩 720 |
| **140 mm/s** | 🟪 19600 |🟥 9800 |🟧 3920 |🟨 1960 |🟩 980 |
| **160 mm/s** | 🟪 25600 |🟪 12800 |🟧 5120 |🟧 2560 |🟨 1280 |
| **180 mm/s** | 🟪 32400 |🟪 16200 |🟥 6480 |🟧 3240 |🟨 1620 |
| **200 mm/s** | 🟪 40000 |🟪 20000 |🟥 8000 |🟧 4000 |🟨 2000 |


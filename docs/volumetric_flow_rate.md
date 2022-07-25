# (Maximum) Volumetric Flow Rates in FDM-style 3d printer

## Introduction

The term "volumetric flow rate" in the context of FDM-style 3d printers describes the volume of material which is printed per second. It usually has the unit mm^3/s (aka 'cubic millimeter per second'). A typical entry level printer achieves about 6-8 mm^3/s, high-end hobbyist setups can do 30-50 mm^3/s and there are a few enthusiasts which push their setups beyond 100+ mm^3/s. In some industrial applications the volumetric flow rate might be even much higher.

If you slice your model with a typical slicer profile with a line width of 0.4 mm, a layer height of 0.1 mm, and a speed of 60 mm/s this results in a volumetric flow rate of about 2.3 mm^3/s. This means that for "normal" settings the maximum volumetric flow rate can be ignored because even the cheapest hotend/extruder combo should be capable of providing at least double that flow rate. But as soon as you want to explore faster printing speeds, larger nozzles diameters, or thicker layers you might run into artifacts or failed prints due to underextrusion.

The maximum volumetric flow rate that a specific setup can achieve depends on the material that is printed, the printing temperature, the diameter of the nozzle, the geometry of the nozzle (CHT nozzles), the wattage of the heating cartridge, the length of the heated portion of the filament path (Volcano-V6-style hotends), the slippage of the extruder, and many other things.

To get a better understanding of the influences of the different parameters I highly recommend the following videos:

* [Vector 3D - The Next Generation of Hot End Testing](https://www.youtube.com/watch?v=rrz3bbsnMUI)
* [MirageC - 3D Printer HotEnd Olympics - Episode 01](https://www.youtube.com/watch?v=dAJlLWX0Few) 
* [CNC Kitchen - Automatic Hot End Benchmark Script](https://www.youtube.com/watch?v=lBi0-NotcP0)

If you want to understand which flow rate is being used in your sliced model you can switch your slicer software to the Volumetric Flow Rate visualization:

![Volumetric flow rate in Prusaslicer](/src/images/example-volumetric-flow-in-prusaslicer.png)

Based on the color you can see which volumetric flow rate is used at each point of the print. The above image was taken with Prusaslicer but other slicers offer very similar features.

By using the information provided in this article you should be able to a) guestimate/measure the maximum flow rate that your setup can achieve and b) to estimate which flow rate is actually needed for your print settings.

## What happens at the maximum volumetric flow rate?

If you push your setup one of two things will happen:

* the extruder skips
* die swell

## Some typical max flow rates

In the table below you find some values for the maximum volumetric flow rates for a bunch of different hotends and nozzles. You can use it to guesstimate the rough performance of your own setup

**Please note:**

The numbers are just a rough estimate because the real world performance will depend on a lot of factors. There are very likely situations in which each of the hotends will provide more or less of the advertised flow rate. 

| Max flow / mm^3/s | Material | Nozzle / mm  | Hotend                | Comment / Source |
| -------------     | ----     | ---          | ---                   | -------------    |
| 6-8               | PLA      | 0.4 Stock    | Ender 3               | [CNC Kitchen - Bi-Metallic Heat Breaks @ 11:01](https://youtu.be/xAiUZ7HDhdM?t=660)  and [CNC Kitchen - Automatic Hot End Benchmark @ 06:35](https://youtu.be/lBi0-NotcP0?t=395)    |
| 14                | PLA      | 0.4 Stock    | E3D V6                | [MirageC - Hotend Olympics Episode 1 @ 20:00](https://youtu.be/dAJlLWX0Few?t=1200)  |
| 10-15             | PLA      | 0.6 Stock    | E3D V6                | [CNC Kitchen - Bondtech CHT Review @ 06:04](https://youtu.be/UNJdv5bFGOg?t=364) and [CNC Kitchen - DIY High Flow Nozzle @ 12:49](https://youtu.be/RWDErj-pE1c?t=769) |
| 12-14             | PLA      | 0.4 Stock    | Revo Six              | [CNC Kitchen - Revo Six Review @ 19:02](https://youtu.be/DdZlBiFajWE?t=1142)    |
| 20-25             | PLA      | 0.6 Stock    | E3d Volcano           | [CNC Kitchen - Bondtech CHT Review @ 06:36](https://youtu.be/UNJdv5bFGOg?t=396) and [CNC Kitchen - DIY High Flow Nozzle @ 13:15](https://youtu.be/RWDErj-pE1c?t=795) |
| 40-45             | PLA      | 0.6 CHT      | E3D V6                | [CNC Kitchen - Bondtech CHT Review @ 07:29](https://youtu.be/UNJdv5bFGOg?t=449)  and [CNC Kitchen - DIY High Flow Nozzle @ 14:35](https://youtu.be/RWDErj-pE1c?t=875)     |
| 45                | PLA      | 1.0 Stock    | Mosquito Magnum+ 100W | [Vector 3D - Extensive Mosquito Magnum+ Flow Testing @ 18:45](https://youtu.be/KtrmYgOr-ZY?t=1125) |
| 110               | PETG     |              | LSD                   | [Vez3D - LSD Hotend flow test](https://youtu.be/5nwWHRBwtsI?t=665)   

(A note regarding E3D V6 vs E3D Revo: Even though the numbers above do not show it, on average the Revo has a slightly higher flow rate than the V6)

Another table of max flow rates can be found in [Andrew Ellis Print Tuning Guide](https://github.com/AndrewEllis93/Print-Tuning-Guide/blob/main/articles/determining_max_volumetric_flow_rate.md#approximate-values)

## Flow rates for a lot of slicer settings

This section contains flow rates for a wide range of layer heights, line widths and print speeds. For example a layer height of 0.2 mm, a line width of 0.4 mm and a speed of 100 mm/s results in a flow of 7.1 mm^3/s.

The color coding is as follows:

* 🟩 < 7 mm^3/s - standard ender 3 style hotends. Every printer should be able to do this
* 🟨 < 14 mm^3/s - E3D V6 and E3D Revo and similar hotends
* 🟧 < 25 mm^3/s - E3D Volcano hotends / hotends with CHT nozzles
* 🟥 < 50 mm^3/s - High end hotends like Mosquito
* 🟪 > 50 mm^3/s - High end / DIY / industrial

**Please note:**

The flow rates are calculated according to Prusaslicers / Slic3rs [Flow math](https://manual.slic3r.org/advanced/flow-math). The numbers might be slightly different for other slicers 

### Layer height:  0.10 mm
|  | w =  0.30 mm | w =  0.40 mm | w =  0.50 mm | w =  0.60 mm | w =  0.70 mm | w =  0.80 mm | w =  0.90 mm | 
| --- | --- | --- | --- | --- | --- | --- | --- | 
| v = 40 mm/s | 🟩 1.1  | 🟩 1.5  | 🟩 1.9  | 🟩 2.3  | 🟩 2.7  | 🟩 3.1  | 🟩 3.5  | 
| v = 60 mm/s | 🟩 1.7  | 🟩 2.3  | 🟩 2.9  | 🟩 3.5  | 🟩 4.1  | 🟩 4.7  | 🟩 5.3  | 
| v = 80 mm/s | 🟩 2.2  | 🟩 3.0  | 🟩 3.8  | 🟩 4.6  | 🟩 5.4  | 🟩 6.2  | 🟨 7.0  | 
| v = 100 mm/s | 🟩 2.8  | 🟩 3.8  | 🟩 4.8  | 🟩 5.8  | 🟩 6.8  | 🟨 7.8  | 🟨 8.8  | 
| v = 120 mm/s | 🟩 3.3  | 🟩 4.5  | 🟩 5.7  | 🟩 6.9  | 🟨 8.1  | 🟨 9.3  | 🟨 10.5  | 
| v = 140 mm/s | 🟩 3.9  | 🟩 5.3  | 🟩 6.7  | 🟨 8.1  | 🟨 9.5  | 🟨 10.9  | 🟨 12.3  | 
| v = 160 mm/s | 🟩 4.5  | 🟩 6.1  | 🟨 7.7  | 🟨 9.3  | 🟨 10.9  | 🟨 12.5  | 🟧 14.1  | 
| v = 180 mm/s | 🟩 5.0  | 🟩 6.8  | 🟨 8.6  | 🟨 10.4  | 🟨 12.2  | 🟧 14.0  | 🟧 15.8  | 
| v = 200 mm/s | 🟩 5.6  | 🟨 7.6  | 🟨 9.6  | 🟨 11.6  | 🟨 13.6  | 🟧 15.6  | 🟧 17.6  | 

### Layer height:  0.20 mm
|  | w =  0.30 mm | w =  0.40 mm | w =  0.50 mm | w =  0.60 mm | w =  0.70 mm | w =  0.80 mm | w =  0.90 mm | 
| --- | --- | --- | --- | --- | --- | --- | --- | 
| v = 40 mm/s | 🟩 2.1  | 🟩 2.9  | 🟩 3.7  | 🟩 4.5  | 🟩 5.3  | 🟩 6.1  | 🟩 6.9  | 
| v = 60 mm/s | 🟩 3.1  | 🟩 4.3  | 🟩 5.5  | 🟩 6.7  | 🟨 7.9  | 🟨 9.1  | 🟨 10.3  | 
| v = 80 mm/s | 🟩 4.1  | 🟩 5.7  | 🟨 7.3  | 🟨 8.9  | 🟨 10.5  | 🟨 12.1  | 🟨 13.7  | 
| v = 100 mm/s | 🟩 5.1  | 🟨 7.1  | 🟨 9.1  | 🟨 11.1  | 🟨 13.1  | 🟧 15.1  | 🟧 17.1  | 
| v = 120 mm/s | 🟩 6.2  | 🟨 8.6  | 🟨 11.0  | 🟨 13.4  | 🟧 15.8  | 🟧 18.2  | 🟧 20.6  | 
| v = 140 mm/s | 🟨 7.2  | 🟨 10.0  | 🟨 12.8  | 🟧 15.6  | 🟧 18.4  | 🟧 21.2  | 🟧 24.0  | 
| v = 160 mm/s | 🟨 8.2  | 🟨 11.4  | 🟧 14.6  | 🟧 17.8  | 🟧 21.0  | 🟧 24.2  | 🟥 27.4  | 
| v = 180 mm/s | 🟨 9.3  | 🟨 12.9  | 🟧 16.5  | 🟧 20.1  | 🟧 23.7  | 🟥 27.3  | 🟥 30.9  | 
| v = 200 mm/s | 🟨 10.3  | 🟧 14.3  | 🟧 18.3  | 🟧 22.3  | 🟥 26.3  | 🟥 30.3  | 🟥 34.3  | 

### Layer height:  0.30 mm
|  | w =  0.30 mm | w =  0.40 mm | w =  0.50 mm | w =  0.60 mm | w =  0.70 mm | w =  0.80 mm | w =  0.90 mm | 
| --- | --- | --- | --- | --- | --- | --- | --- | 
| v = 40 mm/s | 🟩 2.8  | 🟩 4.0  | 🟩 5.2  | 🟩 6.4  | 🟨 7.6  | 🟨 8.8  | 🟨 10.0  | 
| v = 60 mm/s | 🟩 4.2  | 🟩 6.0  | 🟨 7.8  | 🟨 9.6  | 🟨 11.4  | 🟨 13.2  | 🟧 15.0  | 
| v = 80 mm/s | 🟩 5.7  | 🟨 8.1  | 🟨 10.5  | 🟨 12.9  | 🟧 15.3  | 🟧 17.7  | 🟧 20.1  | 
| v = 100 mm/s | 🟨 7.1  | 🟨 10.1  | 🟨 13.1  | 🟧 16.1  | 🟧 19.1  | 🟧 22.1  | 🟥 25.1  | 
| v = 120 mm/s | 🟨 8.5  | 🟨 12.1  | 🟧 15.7  | 🟧 19.3  | 🟧 22.9  | 🟥 26.5  | 🟥 30.1  | 
| v = 140 mm/s | 🟨 9.9  | 🟧 14.1  | 🟧 18.3  | 🟧 22.5  | 🟥 26.7  | 🟥 30.9  | 🟥 35.1  | 
| v = 160 mm/s | 🟨 11.3  | 🟧 16.1  | 🟧 20.9  | 🟥 25.7  | 🟥 30.5  | 🟥 35.3  | 🟥 40.1  | 
| v = 180 mm/s | 🟨 12.7  | 🟧 18.1  | 🟧 23.5  | 🟥 28.9  | 🟥 34.3  | 🟥 39.7  | 🟥 45.1  | 
| v = 200 mm/s | 🟧 14.1  | 🟧 20.1  | 🟥 26.1  | 🟥 32.1  | 🟥 38.1  | 🟥 44.1  | 🟪 50.1  | 

### Layer height:  0.40 mm
|  | w =  0.30 mm | w =  0.40 mm | w =  0.50 mm | w =  0.60 mm | w =  0.70 mm | w =  0.80 mm | w =  0.90 mm | 
| --- | --- | --- | --- | --- | --- | --- | --- | 
| v = 40 mm/s | 🟩 3.4  | 🟩 5.0  | 🟩 6.6  | 🟨 8.2  | 🟨 9.8  | 🟨 11.4  | 🟨 13.0  | 
| v = 60 mm/s | 🟩 5.1  | 🟨 7.5  | 🟨 9.9  | 🟨 12.3  | 🟧 14.7  | 🟧 17.1  | 🟧 19.5  | 
| v = 80 mm/s | 🟩 6.9  | 🟨 10.1  | 🟨 13.3  | 🟧 16.5  | 🟧 19.7  | 🟧 22.9  | 🟥 26.1  | 
| v = 100 mm/s | 🟨 8.6  | 🟨 12.6  | 🟧 16.6  | 🟧 20.6  | 🟧 24.6  | 🟥 28.6  | 🟥 32.6  | 
| v = 120 mm/s | 🟨 10.3  | 🟧 15.1  | 🟧 19.9  | 🟧 24.7  | 🟥 29.5  | 🟥 34.3  | 🟥 39.1  | 
| v = 140 mm/s | 🟨 12.0  | 🟧 17.6  | 🟧 23.2  | 🟥 28.8  | 🟥 34.4  | 🟥 40.0  | 🟥 45.6  | 
| v = 160 mm/s | 🟨 13.7  | 🟧 20.1  | 🟥 26.5  | 🟥 32.9  | 🟥 39.3  | 🟥 45.7  | 🟪 52.1  | 
| v = 180 mm/s | 🟧 15.4  | 🟧 22.6  | 🟥 29.8  | 🟥 37.0  | 🟥 44.2  | 🟪 51.4  | 🟪 58.6  | 
| v = 200 mm/s | 🟧 17.1  | 🟥 25.1  | 🟥 33.1  | 🟥 41.1  | 🟥 49.1  | 🟪 57.1  | 🟪 65.1  | 

### Layer height:  0.50 mm
|  | w =  0.30 mm | w =  0.40 mm | w =  0.50 mm | w =  0.60 mm | w =  0.70 mm | w =  0.80 mm | w =  0.90 mm | 
| --- | --- | --- | --- | --- | --- | --- | --- | 
| v = 40 mm/s | 🟩 3.9  | 🟩 5.9  | 🟨 7.9  | 🟨 9.9  | 🟨 11.9  | 🟨 13.9  | 🟧 15.9  | 
| v = 60 mm/s | 🟩 5.8  | 🟨 8.8  | 🟨 11.8  | 🟧 14.8  | 🟧 17.8  | 🟧 20.8  | 🟧 23.8  | 
| v = 80 mm/s | 🟨 7.7  | 🟨 11.7  | 🟧 15.7  | 🟧 19.7  | 🟧 23.7  | 🟥 27.7  | 🟥 31.7  | 
| v = 100 mm/s | 🟨 9.6  | 🟧 14.6  | 🟧 19.6  | 🟧 24.6  | 🟥 29.6  | 🟥 34.6  | 🟥 39.6  | 
| v = 120 mm/s | 🟨 11.6  | 🟧 17.6  | 🟧 23.6  | 🟥 29.6  | 🟥 35.6  | 🟥 41.6  | 🟥 47.6  | 
| v = 140 mm/s | 🟨 13.5  | 🟧 20.5  | 🟥 27.5  | 🟥 34.5  | 🟥 41.5  | 🟥 48.5  | 🟪 55.5  | 
| v = 160 mm/s | 🟧 15.4  | 🟧 23.4  | 🟥 31.4  | 🟥 39.4  | 🟥 47.4  | 🟪 55.4  | 🟪 63.4  | 
| v = 180 mm/s | 🟧 17.3  | 🟥 26.3  | 🟥 35.3  | 🟥 44.3  | 🟪 53.3  | 🟪 62.3  | 🟪 71.3  | 
| v = 200 mm/s | 🟧 19.3  | 🟥 29.3  | 🟥 39.3  | 🟥 49.3  | 🟪 59.3  | 🟪 69.3  | 🟪 79.3  | 

### Layer height:  0.60 mm
|  | w =  0.30 mm | w =  0.40 mm | w =  0.50 mm | w =  0.60 mm | w =  0.70 mm | w =  0.80 mm | w =  0.90 mm | 
| --- | --- | --- | --- | --- | --- | --- | --- | 
| v = 40 mm/s | 🟩 4.1  | 🟩 6.5  | 🟨 8.9  | 🟨 11.3  | 🟨 13.7  | 🟧 16.1  | 🟧 18.5  | 
| v = 60 mm/s | 🟩 6.2  | 🟨 9.8  | 🟨 13.4  | 🟧 17.0  | 🟧 20.6  | 🟧 24.2  | 🟥 27.8  | 
| v = 80 mm/s | 🟨 8.2  | 🟨 13.0  | 🟧 17.8  | 🟧 22.6  | 🟥 27.4  | 🟥 32.2  | 🟥 37.0  | 
| v = 100 mm/s | 🟨 10.3  | 🟧 16.3  | 🟧 22.3  | 🟥 28.3  | 🟥 34.3  | 🟥 40.3  | 🟥 46.3  | 
| v = 120 mm/s | 🟨 12.3  | 🟧 19.5  | 🟥 26.7  | 🟥 33.9  | 🟥 41.1  | 🟥 48.3  | 🟪 55.5  | 
| v = 140 mm/s | 🟧 14.4  | 🟧 22.8  | 🟥 31.2  | 🟥 39.6  | 🟥 48.0  | 🟪 56.4  | 🟪 64.8  | 
| v = 160 mm/s | 🟧 16.4  | 🟥 26.0  | 🟥 35.6  | 🟥 45.2  | 🟪 54.8  | 🟪 64.4  | 🟪 74.0  | 
| v = 180 mm/s | 🟧 18.5  | 🟥 29.3  | 🟥 40.1  | 🟪 50.9  | 🟪 61.7  | 🟪 72.5  | 🟪 83.3  | 
| v = 200 mm/s | 🟧 20.5  | 🟥 32.5  | 🟥 44.5  | 🟪 56.5  | 🟪 68.5  | 🟪 80.5  | 🟪 92.5  | 

If you need any other values you can either guesstimate them based on the existing values or you can use [E3Ds Volumetric Flow Rate Calculator](https://e3d-online.zendesk.com/hc/en-us/articles/4418401655569-Volumetric-Flow-Rate-Calculator-)

## Relationship between flow rate and extrusion speed

flow rate is connected...

## How to determine max flow

### Manual measurement

bla blub

### Using a test print

## Videos about flow

* [CNC Kitchen - Bi-Metallic Heat Breaks - A (R)Evolution?!](https://youtu.be/xAiUZ7HDhdM) 'Stock' vs 'Slice Engineering Copperhead Heatbreak' on an Ender 3
* [CNC Kitchen - BondTech CHT Review](https://www.youtube.com/watch?v=UNJdv5bFGOg) 'E3D V6' vs 'E3D V6 Volvano' vs 'E3D V6 + CHT nozzle'
* [CNC Kitchen - DIY High Flow Volcano Adapter](https://www.youtube.com/watch?v=TdndOILeaIo)
* [CNC Kitchen - Automatic Hot End Benchmark Script](https://www.youtube.com/watch?v=lBi0-NotcP0)
* [Vector 3D - The Next Generation of Hot End Testing](https://www.youtube.com/watch?v=rrz3bbsnMUI)
* [Vector 3D - Extensive Mosquito Magnum+ Flow Testing](https://www.youtube.com/watch?v=KtrmYgOr-ZY) Highly detailed testing of a Mosquito Magnum+ with PLA/ABS/PETG
* [MirageC - 3D Printer HotEnd Olympics - Episode 01](https://www.youtube.com/watch?v=dAJlLWX0Few) Highly detailed testing of a E3D V6







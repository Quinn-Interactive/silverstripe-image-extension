# Image Extension

Adds some convenience routines to the Image class.

- Version 3.x is for SilverStripe 3.2 and above (3.2+).  It removes methods that are already built into the Image method of SilverStripe 3.2+ and retains those that are not (eg, Rotate(), TopCroppedResize()).

Upgrade notes for going from QI Image Extension to SS 3.2+ Image:  
  
  
```
	CroppedResize() -> Fill()
	CroppedImage() -> Fill()  
	PaddedResize() -> Pad()
	PaddedImage() -> Pad()  
	ResizeByHeight() -> ScaleHeight()  
	ResizeByWidth() -> ScaleWidth()  
	ResizeRatio() -> Fit()  
	Rotate() -> [no replacement; use ImageExtension]  
	SetHeight() -> ScaleHeight()  
	SetSize() -> Pad() 
	SetRatioSize() -> Fit() 
	SetWidth() -> ScaleWidth()  
	TopCroppedResize() ->  [no replacement; use ImageExtension->TopCroppedImage()]  
```  

NOTE: If existing ImageExtension's methods arguments (the width and height) are expressed as a string, will need to replace with SS3.2+ format, e.g.:   

```
MyImage.CroppedResize('200x200') -> MyImage.Fill(200,200)
```  


- Version 2.x is for SilverStripe 3.1.x.

- Earlier versions were designed for SilverStripe 2.4. The version supporting
SilverStripe 3.x exists only to simplify migrating 2.4 sites to 3.x. All of its
functionality exists natively in SilverStripe 3.x. There will be no further
development of this module.

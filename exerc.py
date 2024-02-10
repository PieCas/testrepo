hrs = input("Enter Hours:")
h = float(hrs)
pay1 = 10.50
if h<=40:
    print (h*pay1)
if h>40:
    print (((h-(h-40))*pay1)+((h-40)*1.5*pay1))

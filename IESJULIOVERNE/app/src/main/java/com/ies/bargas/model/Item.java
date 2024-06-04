package com.ies.bargas.model;

public class Item {
    private String name;
    private int image;
    private int image2;

    public Item(String name, int image, int image2) {
        this.name = name;
        this.image = image;
        this.image2 = image2;
    }

    public Item() {
    }

    public Item(String name, int image) {
        this.name = name;
        this.image = image;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public int getImage() {
        return image;
    }

    public void setImage(int image) {
        this.image = image;
    }

    public int getImage2() {
        return image2;
    }

    public void setImage2(int image2) {
        this.image2 = image2;
    }

    @Override
    public String toString() {
        return "Items{" +
                "name='" + name + '\'' +
                ", image=" + image +
                ", image2=" + image2 +
                '}';
    }
}
